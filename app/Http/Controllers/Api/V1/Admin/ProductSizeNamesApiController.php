<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductSizeNameRequest;
use App\Http\Requests\UpdateProductSizeNameRequest;
use App\Http\Resources\Admin\ProductSizeNameResource;
use App\Models\ProductSizeName;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductSizeNamesApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('product_size_name_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProductSizeNameResource(ProductSizeName::all());
    }

    public function store(StoreProductSizeNameRequest $request)
    {
        $productSizeName = ProductSizeName::create($request->all());

        return (new ProductSizeNameResource($productSizeName))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ProductSizeName $productSizeName)
    {
        abort_if(Gate::denies('product_size_name_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProductSizeNameResource($productSizeName);
    }

    public function update(UpdateProductSizeNameRequest $request, ProductSizeName $productSizeName)
    {
        $productSizeName->update($request->all());

        return (new ProductSizeNameResource($productSizeName))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ProductSizeName $productSizeName)
    {
        abort_if(Gate::denies('product_size_name_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productSizeName->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
