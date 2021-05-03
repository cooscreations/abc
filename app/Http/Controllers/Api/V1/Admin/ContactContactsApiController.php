<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreContactContactRequest;
use App\Http\Requests\UpdateContactContactRequest;
use App\Http\Resources\Admin\ContactContactResource;
use App\Models\ContactContact;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ContactContactsApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('contact_contact_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ContactContactResource(ContactContact::with(['user', 'country_of_birth', 'primary_address', 'current_country', 'company', 'default_language', 'roles'])->get());
    }

    public function store(StoreContactContactRequest $request)
    {
        $contactContact = ContactContact::create($request->all());
        $contactContact->roles()->sync($request->input('roles', []));
        if ($request->input('photo', false)) {
            $contactContact->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        if ($request->input('business_card', false)) {
            $contactContact->addMedia(storage_path('tmp/uploads/' . basename($request->input('business_card'))))->toMediaCollection('business_card');
        }

        if ($request->input('qr_code', false)) {
            $contactContact->addMedia(storage_path('tmp/uploads/' . basename($request->input('qr_code'))))->toMediaCollection('qr_code');
        }

        return (new ContactContactResource($contactContact))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ContactContact $contactContact)
    {
        abort_if(Gate::denies('contact_contact_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ContactContactResource($contactContact->load(['user', 'country_of_birth', 'primary_address', 'current_country', 'company', 'default_language', 'roles']));
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

        if ($request->input('business_card', false)) {
            if (!$contactContact->business_card || $request->input('business_card') !== $contactContact->business_card->file_name) {
                if ($contactContact->business_card) {
                    $contactContact->business_card->delete();
                }
                $contactContact->addMedia(storage_path('tmp/uploads/' . basename($request->input('business_card'))))->toMediaCollection('business_card');
            }
        } elseif ($contactContact->business_card) {
            $contactContact->business_card->delete();
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

        return (new ContactContactResource($contactContact))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ContactContact $contactContact)
    {
        abort_if(Gate::denies('contact_contact_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contactContact->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
