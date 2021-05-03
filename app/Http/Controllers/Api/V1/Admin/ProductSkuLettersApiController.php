<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductSkuLetterRequest;
use App\Http\Requests\UpdateProductSkuLetterRequest;
use App\Http\Resources\Admin\ProductSkuLetterResource;
use App\Models\ProductSkuLetter;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductSkuLettersApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('product_sku_letter_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProductSkuLetterResource(ProductSkuLetter::all());
    }

    public function store(StoreProductSkuLetterRequest $request)
    {
        $productSkuLetter = ProductSkuLetter::create($request->all());

        return (new ProductSkuLetterResource($productSkuLetter))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ProductSkuLetter $productSkuLetter)
    {
        abort_if(Gate::denies('product_sku_letter_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProductSkuLetterResource($productSkuLetter);
    }

    public function update(UpdateProductSkuLetterRequest $request, ProductSkuLetter $productSkuLetter)
    {
        $productSkuLetter->update($request->all());

        return (new ProductSkuLetterResource($productSkuLetter))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ProductSkuLetter $productSkuLetter)
    {
        abort_if(Gate::denies('product_sku_letter_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productSkuLetter->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
