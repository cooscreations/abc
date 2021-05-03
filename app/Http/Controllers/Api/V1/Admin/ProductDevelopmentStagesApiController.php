<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductDevelopmentStageRequest;
use App\Http\Requests\UpdateProductDevelopmentStageRequest;
use App\Http\Resources\Admin\ProductDevelopmentStageResource;
use App\Models\ProductDevelopmentStage;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductDevelopmentStagesApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('product_development_stage_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProductDevelopmentStageResource(ProductDevelopmentStage::all());
    }

    public function store(StoreProductDevelopmentStageRequest $request)
    {
        $productDevelopmentStage = ProductDevelopmentStage::create($request->all());

        return (new ProductDevelopmentStageResource($productDevelopmentStage))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ProductDevelopmentStage $productDevelopmentStage)
    {
        abort_if(Gate::denies('product_development_stage_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProductDevelopmentStageResource($productDevelopmentStage);
    }

    public function update(UpdateProductDevelopmentStageRequest $request, ProductDevelopmentStage $productDevelopmentStage)
    {
        $productDevelopmentStage->update($request->all());

        return (new ProductDevelopmentStageResource($productDevelopmentStage))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ProductDevelopmentStage $productDevelopmentStage)
    {
        abort_if(Gate::denies('product_development_stage_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productDevelopmentStage->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
