<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDocumentRequest;
use App\Http\Requests\UpdateDocumentRequest;
use App\Http\Resources\Admin\DocumentResource;
use App\Models\Document;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DocumentsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('document_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DocumentResource(Document::with(['related_orders', 'related_products', 'related_skus', 'related_users', 'related_companies', 'related_contacts', 'document_type', 'file_type', 'authorised_user_types'])->get());
    }

    public function store(StoreDocumentRequest $request)
    {
        $document = Document::create($request->all());
        $document->related_orders()->sync($request->input('related_orders', []));
        $document->related_products()->sync($request->input('related_products', []));
        $document->related_skus()->sync($request->input('related_skus', []));
        $document->related_users()->sync($request->input('related_users', []));
        $document->related_companies()->sync($request->input('related_companies', []));
        $document->related_contacts()->sync($request->input('related_contacts', []));
        $document->authorised_user_types()->sync($request->input('authorised_user_types', []));

        return (new DocumentResource($document))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Document $document)
    {
        abort_if(Gate::denies('document_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DocumentResource($document->load(['related_orders', 'related_products', 'related_skus', 'related_users', 'related_companies', 'related_contacts', 'document_type', 'file_type', 'authorised_user_types']));
    }

    public function update(UpdateDocumentRequest $request, Document $document)
    {
        $document->update($request->all());
        $document->related_orders()->sync($request->input('related_orders', []));
        $document->related_products()->sync($request->input('related_products', []));
        $document->related_skus()->sync($request->input('related_skus', []));
        $document->related_users()->sync($request->input('related_users', []));
        $document->related_companies()->sync($request->input('related_companies', []));
        $document->related_contacts()->sync($request->input('related_contacts', []));
        $document->authorised_user_types()->sync($request->input('authorised_user_types', []));

        return (new DocumentResource($document))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Document $document)
    {
        abort_if(Gate::denies('document_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $document->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
