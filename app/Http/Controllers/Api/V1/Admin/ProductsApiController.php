<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\Admin\ProductResource;
use App\Models\Product;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductsApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('product_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProductResource(Product::with(['primary_nickname', 'product_code_group', 'default_function', 'product_collection', 'default_group', 'default_storage', 'default_gas_lift_config', 'default_drawer_config', 'default_drawer_movement', 'default_tv_config', 'default_visitor_config', 'extra_letters_used_in_skus', 'primary_material', 'primary_suppliers', 'std_packaging'])->get());
    }

    public function store(StoreProductRequest $request)
    {
        $product = Product::create($request->all());
        $product->extra_letters_used_in_skus()->sync($request->input('extra_letters_used_in_skus', []));
        $product->primary_suppliers()->sync($request->input('primary_suppliers', []));
        if ($request->input('beauty_shot', false)) {
            $product->addMedia(storage_path('tmp/uploads/' . basename($request->input('beauty_shot'))))->toMediaCollection('beauty_shot');
        }

        if ($request->input('iso_naked', false)) {
            $product->addMedia(storage_path('tmp/uploads/' . basename($request->input('iso_naked'))))->toMediaCollection('iso_naked');
        }

        if ($request->input('other_photos', false)) {
            $product->addMedia(storage_path('tmp/uploads/' . basename($request->input('other_photos'))))->toMediaCollection('other_photos');
        }

        return (new ProductResource($product))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Product $product)
    {
        abort_if(Gate::denies('product_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProductResource($product->load(['primary_nickname', 'product_code_group', 'default_function', 'product_collection', 'default_group', 'default_storage', 'default_gas_lift_config', 'default_drawer_config', 'default_drawer_movement', 'default_tv_config', 'default_visitor_config', 'extra_letters_used_in_skus', 'primary_material', 'primary_suppliers', 'std_packaging']));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->all());
        $product->extra_letters_used_in_skus()->sync($request->input('extra_letters_used_in_skus', []));
        $product->primary_suppliers()->sync($request->input('primary_suppliers', []));
        if ($request->input('beauty_shot', false)) {
            if (!$product->beauty_shot || $request->input('beauty_shot') !== $product->beauty_shot->file_name) {
                if ($product->beauty_shot) {
                    $product->beauty_shot->delete();
                }
                $product->addMedia(storage_path('tmp/uploads/' . basename($request->input('beauty_shot'))))->toMediaCollection('beauty_shot');
            }
        } elseif ($product->beauty_shot) {
            $product->beauty_shot->delete();
        }

        if ($request->input('iso_naked', false)) {
            if (!$product->iso_naked || $request->input('iso_naked') !== $product->iso_naked->file_name) {
                if ($product->iso_naked) {
                    $product->iso_naked->delete();
                }
                $product->addMedia(storage_path('tmp/uploads/' . basename($request->input('iso_naked'))))->toMediaCollection('iso_naked');
            }
        } elseif ($product->iso_naked) {
            $product->iso_naked->delete();
        }

        if ($request->input('other_photos', false)) {
            if (!$product->other_photos || $request->input('other_photos') !== $product->other_photos->file_name) {
                if ($product->other_photos) {
                    $product->other_photos->delete();
                }
                $product->addMedia(storage_path('tmp/uploads/' . basename($request->input('other_photos'))))->toMediaCollection('other_photos');
            }
        } elseif ($product->other_photos) {
            $product->other_photos->delete();
        }

        return (new ProductResource($product))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Product $product)
    {
        abort_if(Gate::denies('product_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $product->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
