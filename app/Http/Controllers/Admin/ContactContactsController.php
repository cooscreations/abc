<?php

namespace App\Http\Controllers\Admin;

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
use Yajra\DataTables\Facades\DataTables;

class ContactContactsController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('contact_contact_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ContactContact::with(['user', 'country_of_birth', 'primary_address', 'current_country', 'company', 'default_language', 'roles'])->select(sprintf('%s.*', (new ContactContact())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'contact_contact_show';
                $editGate = 'contact_contact_edit';
                $deleteGate = 'contact_contact_delete';
                $crudRoutePart = 'contact-contacts';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('contact_first_name', function ($row) {
                return $row->contact_first_name ? $row->contact_first_name : '';
            });
            $table->editColumn('contact_last_name', function ($row) {
                return $row->contact_last_name ? $row->contact_last_name : '';
            });
            $table->editColumn('local_name', function ($row) {
                return $row->local_name ? $row->local_name : '';
            });
            $table->addColumn('current_country_alpha_2', function ($row) {
                return $row->current_country ? $row->current_country->alpha_2 : '';
            });

            $table->editColumn('current_country.name', function ($row) {
                return $row->current_country ? (is_string($row->current_country) ? $row->current_country : $row->current_country->name) : '';
            });
            $table->addColumn('company_company_name', function ($row) {
                return $row->company ? $row->company->company_name : '';
            });

            $table->editColumn('photo', function ($row) {
                if ($photo = $row->photo) {
                    return sprintf(
        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
        $photo->url,
        $photo->thumbnail
    );
                }

                return '';
            });
            $table->editColumn('contact_email', function ($row) {
                return $row->contact_email ? $row->contact_email : '';
            });
            $table->editColumn('mobile_phone', function ($row) {
                return $row->mobile_phone ? $row->mobile_phone : '';
            });
            $table->addColumn('default_language_alpha_2', function ($row) {
                return $row->default_language ? $row->default_language->alpha_2 : '';
            });

            $table->editColumn('default_language.name', function ($row) {
                return $row->default_language ? (is_string($row->default_language) ? $row->default_language : $row->default_language->name) : '';
            });
            $table->editColumn('roles', function ($row) {
                $labels = [];
                foreach ($row->roles as $role) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $role->title);
                }

                return implode(' ', $labels);
            });

            $table->rawColumns(['actions', 'placeholder', 'current_country', 'company', 'photo', 'default_language', 'roles']);

            return $table->make(true);
        }

        $users             = User::get();
        $countries         = Country::get();
        $addresses         = Address::get();
        $contact_companies = ContactCompany::get();
        $languages         = Language::get();
        $roles             = Role::get();

        return view('admin.contactContacts.index', compact('users', 'countries', 'addresses', 'contact_companies', 'languages', 'roles'));
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

        return view('admin.contactContacts.create', compact('users', 'country_of_births', 'primary_addresses', 'current_countries', 'companies', 'default_languages', 'roles'));
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

        return redirect()->route('admin.contact-contacts.index');
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

        return view('admin.contactContacts.edit', compact('users', 'country_of_births', 'primary_addresses', 'current_countries', 'companies', 'default_languages', 'roles', 'contactContact'));
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

        return redirect()->route('admin.contact-contacts.index');
    }

    public function show(ContactContact $contactContact)
    {
        abort_if(Gate::denies('contact_contact_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contactContact->load('user', 'country_of_birth', 'primary_address', 'current_country', 'company', 'default_language', 'roles', 'ownerContactContactCompanies', 'orderPlacedByOrders', 'contactOrderRoles', 'contactCompanyRoles', 'salesPersonOrders', 'relatedContactsDocuments');

        return view('admin.contactContacts.show', compact('contactContact'));
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
