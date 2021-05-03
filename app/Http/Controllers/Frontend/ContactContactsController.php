<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyContactContactRequest;
use App\Http\Requests\StoreContactContactRequest;
use App\Http\Requests\UpdateContactContactRequest;
use App\Models\Address;
use App\Models\ContactCompany;
use App\Models\ContactContact;
use App\Models\Country;
use App\Models\Language;
use App\Models\Role;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class ContactContactsController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('contact_contact_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contactContacts = ContactContact::with(['user', 'country_of_birth', 'primary_address', 'current_country', 'company', 'default_language', 'roles', 'media'])->get();

        $users = User::get();

        $countries = Country::get();

        $addresses = Address::get();

        $contact_companies = ContactCompany::get();

        $languages = Language::get();

        $roles = Role::get();

        return view('frontend.contactContacts.index', compact('contactContacts', 'users', 'countries', 'addresses', 'contact_companies', 'languages', 'roles'));
    }

    public function create()
    {
        abort_if(Gate::denies('contact_contact_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $country_of_births = Country::all()->pluck('alpha_2', 'id')->prepend(trans('global.pleaseSelect'), '');

        $primary_addresses = Address::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $current_countries = Country::all()->pluck('alpha_2', 'id')->prepend(trans('global.pleaseSelect'), '');

        $companies = ContactCompany::all()->pluck('company_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $default_languages = Language::all()->pluck('alpha_2', 'id')->prepend(trans('global.pleaseSelect'), '');

        $roles = Role::all()->pluck('title', 'id');

        return view('frontend.contactContacts.create', compact('users', 'country_of_births', 'primary_addresses', 'current_countries', 'companies', 'default_languages', 'roles'));
    }

    public function store(StoreContactContactRequest $request)
    {
        $contactContact = ContactContact::create($request->all());
        $contactContact->roles()->sync($request->input('roles', []));
        if ($request->input('photo', false)) {
            $contactContact->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        foreach ($request->input('business_card', []) as $file) {
            $contactContact->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('business_card');
        }

        if ($request->input('qr_code', false)) {
            $contactContact->addMedia(storage_path('tmp/uploads/' . basename($request->input('qr_code'))))->toMediaCollection('qr_code');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $contactContact->id]);
        }

        return redirect()->route('frontend.contact-contacts.index');
    }

    public function edit(ContactContact $contactContact)
    {
        abort_if(Gate::denies('contact_contact_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $country_of_births = Country::all()->pluck('alpha_2', 'id')->prepend(trans('global.pleaseSelect'), '');

        $primary_addresses = Address::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $current_countries = Country::all()->pluck('alpha_2', 'id')->prepend(trans('global.pleaseSelect'), '');

        $companies = ContactCompany::all()->pluck('company_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $default_languages = Language::all()->pluck('alpha_2', 'id')->prepend(trans('global.pleaseSelect'), '');

        $roles = Role::all()->pluck('title', 'id');

        $contactContact->load('user', 'country_of_birth', 'primary_address', 'current_country', 'company', 'default_language', 'roles');

        return view('frontend.contactContacts.edit', compact('users', 'country_of_births', 'primary_addresses', 'current_countries', 'companies', 'default_languages', 'roles', 'contactContact'));
    }

    public function update(UpdateContactContactRequest $request, ContactContact $contactContact)
    {
        $contactContact->update($request->all());
        $contactContact->roles()->sync($request->input('roles', []));
        if ($request->input('photo', false)) {
            if (!$contactContact->photo || $request->input('photo') !== $contactContact->photo->file_name) {
                if ($contactContact->photo) {
                    $contactContact->photo->delete();
                }
                $contactContact->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
            }
        } elseif ($contactContact->photo) {
            $contactContact->photo->delete();
        }

        if (count($contactContact->business_card) > 0) {
            foreach ($contactContact->business_card as $media) {
                if (!in_array($media->file_name, $request->input('business_card', []))) {
                    $media->delete();
                }
            }
        }
        $media = $contactContact->business_card->pluck('file_name')->toArray();
        foreach ($request->input('business_card', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $contactContact->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('business_card');
            }
        }

        if ($request->input('qr_code', false)) {
            if (!$contactContact->qr_code || $request->input('qr_code') !== $contactContact->qr_code->file_name) {
                if ($contactContact->qr_code) {
                    $contactContact->qr_code->delete();
                }
                $contactContact->addMedia(storage_path('tmp/uploads/' . basename($request->input('qr_code'))))->toMediaCollection('qr_code');
            }
        } elseif ($contactContact->qr_code) {
            $contactContact->qr_code->delete();
        }

        return redirect()->route('frontend.contact-contacts.index');
    }

    public function show(ContactContact $contactContact)
    {
        abort_if(Gate::denies('contact_contact_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contactContact->load('user', 'country_of_birth', 'primary_address', 'current_country', 'company', 'default_language', 'roles', 'ownerContactContactCompanies', 'orderPlacedByOrders', 'contactOrderRoles', 'contactCompanyRoles', 'salesPersonOrders', 'relatedContactsDocuments');

        return view('frontend.contactContacts.show', compact('contactContact'));
    }

    public function destroy(ContactContact $contactContact)
    {
        abort_if(Gate::denies('contact_contact_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contactContact->delete();

        return back();
    }

    public function massDestroy(MassDestroyContactContactRequest $request)
    {
        ContactContact::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('contact_contact_create') && Gate::denies('contact_contact_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new ContactContact();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
