<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyProductCollectionRequest;
use App\Http\Requests\StoreProductCollectionRequest;
use App\Http\Requests\UpdateProductCollectionRequest;
use App\Models\ProductCollection;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductCollectionsController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('product_collection_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productCollections = ProductCollection::all();

        return view('frontend.productCollections.index', compact('productCollections'));
    }

    public function create()
    {
        abort_if(Gate::denies('product_collection_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.productCollections.create');
    }

    public function store(StoreProductCollectionRequest $request)
    {
        $productCollection = ProductCollection::create($request->all());

        return redirect()->route('frontend.product-collections.index');
    }

    public function edit(ProductCollection $productCollection)
    {
        abort_if(Gate::denies('product_collection_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.productCollections.edit', compact('productCollection'));
    }

    public function update(UpdateProductCollectionRequest $request, ProductCollection $productCollection)
    {
        $productCollection->update($request->all());

        return redirect()->route('frontend.product-collections.index');
    }

    public function show(ProductCollection $productCollection)
    {
        abort_if(Gate::denies('product_collection_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productCollection->load('productCollectionProducts', 'productCollectionProductCodeGroups');

        return view('frontend.productCollections.show', compact('productCollection'));
    }

    public function destroy(ProductCollection $productCollection)
    {
        abort_if(Gate::denies('product_collection_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productCollection->delete();

        return back();
    }

    public function massDestroy(MassDestroyProductCollectionRequest $request)
    {
        ProductCollection::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
