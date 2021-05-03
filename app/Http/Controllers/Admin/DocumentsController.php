<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyDocumentRequest;
use App\Http\Requests\StoreDocumentRequest;
use App\Http\Requests\UpdateDocumentRequest;
use App\Models\ContactCompany;
use App\Models\ContactContact;
use App\Models\Document;
use App\Models\DocumentType;
use App\Models\FileType;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductSku;
use App\Models\User;
use App\Models\UserType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DocumentsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('document_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $documents = Document::with(['related_orders', 'related_products', 'related_skus', 'related_users', 'related_companies', 'related_contacts', 'document_type', 'file_type', 'authorised_user_types'])->get();

        $orders = Order::get();

        $products = Product::get();

        $product_skus = ProductSku::get();

        $users = User::get();

        $contact_companies = ContactCompany::get();

        $contact_contacts = ContactContact::get();

        $document_types = DocumentType::get();

        $file_types = FileType::get();

        $user_types = UserType::get();

        return view('admin.documents.index', compact('documents', 'orders', 'products', 'product_skus', 'users', 'contact_companies', 'contact_contacts', 'document_types', 'file_types', 'user_types'));
    }

    public function create()
    {
        abort_if(Gate::denies('document_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $related_orders = Order::all()->pluck('afa_order_num', 'id');

        $related_products = Product::all()->pluck('afa_model_number', 'id');

        $related_skus = ProductSku::all()->pluck('product_sku', 'id');

        $related_users = User::all()->pluck('name', 'id');

        $related_companies = ContactCompany::all()->pluck('company_name', 'id');

        $related_contacts = ContactContact::all()->pluck('contact_first_name', 'id');

        $document_types = DocumentType::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $file_types = FileType::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $authorised_user_types = UserType::all()->pluck('name', 'id');

        return view('admin.documents.create', compact('related_orders', 'related_products', 'related_skus', 'related_users', 'related_companies', 'related_contacts', 'document_types', 'file_types', 'authorised_user_types'));
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

        return redirect()->route('admin.documents.index');
    }

    public function edit(Document $document)
    {
        abort_if(Gate::denies('document_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $related_orders = Order::all()->pluck('afa_order_num', 'id');

        $related_products = Product::all()->pluck('afa_model_number', 'id');

        $related_skus = ProductSku::all()->pluck('product_sku', 'id');

        $related_users = User::all()->pluck('name', 'id');

        $related_companies = ContactCompany::all()->pluck('company_name', 'id');

        $related_contacts = ContactContact::all()->pluck('contact_first_name', 'id');

        $document_types = DocumentType::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $file_types = FileType::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $authorised_user_types = UserType::all()->pluck('name', 'id');

        $document->load('related_orders', 'related_products', 'related_skus', 'related_users', 'related_companies', 'related_contacts', 'document_type', 'file_type', 'authorised_user_types');

        return view('admin.documents.edit', compact('related_orders', 'related_products', 'related_skus', 'related_users', 'related_companies', 'related_contacts', 'document_types', 'file_types', 'authorised_user_types', 'document'));
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

        return redirect()->route('admin.documents.index');
    }

    public function show(Document $document)
    {
        abort_if(Gate::denies('document_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $document->load('related_orders', 'related_products', 'related_skus', 'related_users', 'related_companies', 'related_contacts', 'document_type', 'file_type', 'authorised_user_types');

        return view('admin.documents.show', compact('document'));
    }

    public function destroy(Document $document)
    {
        abort_if(Gate::denies('document_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $document->delete();

        return back();
    }

    public function massDestroy(MassDestroyDocumentRequest $request)
    {
        Document::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
