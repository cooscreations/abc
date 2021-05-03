<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyProductDevelopmentStageRequest;
use App\Http\Requests\StoreProductDevelopmentStageRequest;
use App\Http\Requests\UpdateProductDevelopmentStageRequest;
use App\Models\ProductDevelopmentStage;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductDevelopmentStagesController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('product_development_stage_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productDevelopmentStages = ProductDevelopmentStage::all();

        return view('frontend.productDevelopmentStages.index', compact('productDevelopmentStages'));
    }

    public function create()
    {
        abort_if(Gate::denies('product_development_stage_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.productDevelopmentStages.create');
    }

    public function store(StoreProductDevelopmentStageRequest $request)
    {
        $productDevelopmentStage = ProductDevelopmentStage::create($request->all());

        return redirect()->route('frontend.product-development-stages.index');
    }

    public function edit(ProductDevelopmentStage $productDevelopmentStage)
    {
        abort_if(Gate::denies('product_development_stage_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.productDevelopmentStages.edit', compact('productDevelopmentStage'));
    }

    public function update(UpdateProductDevelopmentStageRequest $request, ProductDevelopmentStage $productDevelopmentStage)
    {
        $productDevelopmentStage->update($request->all());

        return redirect()->route('frontend.product-development-stages.index');
    }

    public function show(ProductDevelopmentStage $productDevelopmentStage)
    {
        abort_if(Gate::denies('product_development_stage_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productDevelopmentStage->load('prodDevStageProductSkus');

        return view('frontend.productDevelopmentStages.show', compact('productDevelopmentStage'));
    }

    public function destroy(ProductDevelopmentStage $productDevelopmentStage)
    {
        abort_if(Gate::denies('product_development_stage_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productDevelopmentStage->delete();

        return back();
    }

    public function massDestroy(MassDestroyProductDevelopmentStageRequest $request)
    {
        ProductDevelopmentStage::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
