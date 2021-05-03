<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreProductGroupRequest;
use App\Http\Requests\UpdateProductGroupRequest;
use App\Http\Resources\Admin\ProductGroupResource;
use App\Models\ProductGroup;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductGroupsApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('product_group_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProductGroupResource(ProductGroup::all());
    }

    public function store(StoreProductGroupRequest $request)
    {
        $productGroup = ProductGroup::create($request->all());

        if ($request->input('logo', false)) {
            $productGroup->addMedia(storage_path('tmp/uploads/' . basename($request->input('logo'))))->toMediaCollection('logo');
        }

        return (new ProductGroupResource($productGroup))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ProductGroup $productGroup)
    {
        abort_if(Gate::denies('product_group_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProductGroupResource($productGroup);
    }

    public function update(UpdateProductGroupRequest $request, ProductGroup $productGroup)
    {
        $productGroup->update($request->all());

        if ($request->input('logo', false)) {
            if (!$productGroup->logo || $request->input('logo') !== $productGroup->logo->file_name) {
                if ($productGroup->logo) {
                    $productGroup->logo->delete();
                }
                $productGroup->addMedia(storage_path('tmp/uploads/' . basename($request->input('logo'))))->toMediaCollection('logo');
            }
        } elseif ($productGroup->logo) {
            $productGroup->logo->delete();
        }

        return (new ProductGroupResource($productGroup))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ProductGroup $productGroup)
    {
        abort_if(Gate::denies('product_group_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productGroup->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
