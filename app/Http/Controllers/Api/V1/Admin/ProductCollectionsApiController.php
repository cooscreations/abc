<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductCollectionRequest;
use App\Http\Requests\UpdateProductCollectionRequest;
use App\Http\Resources\Admin\ProductCollectionResource;
use App\Models\ProductCollection;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductCollectionsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('product_collection_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProductCollectionResource(ProductCollection::all());
    }

    public function store(StoreProductCollectionRequest $request)
    {
        $productCollection = ProductCollection::create($request->all());

        return (new ProductCollectionResource($productCollection))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ProductCollection $productCollection)
    {
        abort_if(Gate::denies('product_collection_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProductCollectionResource($productCollection);
    }

    public function update(UpdateProductCollectionRequest $request, ProductCollection $productCollection)
    {
        $productCollection->update($request->all());

        return (new ProductCollectionResource($productCollection))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ProductCollection $productCollection)
    {
        abort_if(Gate::denies('product_collection_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productCollection->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
