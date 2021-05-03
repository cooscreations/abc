<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductSkuRequest;
use App\Http\Requests\UpdateProductSkuRequest;
use App\Http\Resources\Admin\ProductSkuResource;
use App\Models\ProductSku;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductSkuApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('product_sku_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProductSkuResource(ProductSku::with(['product', 'prod_dev_stage', 'size'])->get());
    }

    public function store(StoreProductSkuRequest $request)
    {
        $productSku = ProductSku::create($request->all());

        return (new ProductSkuResource($productSku))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ProductSku $productSku)
    {
        abort_if(Gate::denies('product_sku_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProductSkuResource($productSku->load(['product', 'prod_dev_stage', 'size']));
    }

    public function update(UpdateProductSkuRequest $request, ProductSku $productSku)
    {
        $productSku->update($request->all());

        return (new ProductSkuResource($productSku))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ProductSku $productSku)
    {
        abort_if(Gate::denies('product_sku_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productSku->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
