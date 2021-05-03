<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductCodeGroupRequest;
use App\Http\Requests\UpdateProductCodeGroupRequest;
use App\Http\Resources\Admin\ProductCodeGroupResource;
use App\Models\ProductCodeGroup;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductCodeGroupsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('product_code_group_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProductCodeGroupResource(ProductCodeGroup::with(['product_collections', 'product_functions', 'product_types', 'storage_options'])->get());
    }

    public function store(StoreProductCodeGroupRequest $request)
    {
        $productCodeGroup = ProductCodeGroup::create($request->all());
        $productCodeGroup->product_collections()->sync($request->input('product_collections', []));
        $productCodeGroup->product_functions()->sync($request->input('product_functions', []));
        $productCodeGroup->product_types()->sync($request->input('product_types', []));
        $productCodeGroup->storage_options()->sync($request->input('storage_options', []));

        return (new ProductCodeGroupResource($productCodeGroup))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ProductCodeGroup $productCodeGroup)
    {
        abort_if(Gate::denies('product_code_group_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProductCodeGroupResource($productCodeGroup->load(['product_collections', 'product_functions', 'product_types', 'storage_options']));
    }

    public function update(UpdateProductCodeGroupRequest $request, ProductCodeGroup $productCodeGroup)
    {
        $productCodeGroup->update($request->all());
        $productCodeGroup->product_collections()->sync($request->input('product_collections', []));
        $productCodeGroup->product_functions()->sync($request->input('product_functions', []));
        $productCodeGroup->product_types()->sync($request->input('product_types', []));
        $productCodeGroup->storage_options()->sync($request->input('storage_options', []));

        return (new ProductCodeGroupResource($productCodeGroup))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ProductCodeGroup $productCodeGroup)
    {
        abort_if(Gate::denies('product_code_group_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productCodeGroup->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
