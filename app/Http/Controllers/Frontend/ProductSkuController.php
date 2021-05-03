<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyProductSkuRequest;
use App\Http\Requests\StoreProductSkuRequest;
use App\Http\Requests\UpdateProductSkuRequest;
use App\Models\BedSizesByRegion;
use App\Models\Product;
use App\Models\ProductDevelopmentStage;
use App\Models\ProductSku;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductSkuController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('product_sku_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productSkus = ProductSku::with(['product', 'prod_dev_stage', 'size'])->get();

        $products = Product::get();

        $product_development_stages = ProductDevelopmentStage::get();

        $bed_sizes_by_regions = BedSizesByRegion::get();

        return view('frontend.productSkus.index', compact('productSkus', 'products', 'product_development_stages', 'bed_sizes_by_regions'));
    }

    public function create()
    {
        abort_if(Gate::denies('product_sku_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = Product::all()->pluck('afa_model_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        $prod_dev_stages = ProductDevelopmentStage::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sizes = BedSizesByRegion::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.productSkus.create', compact('products', 'prod_dev_stages', 'sizes'));
    }

    public function store(StoreProductSkuRequest $request)
    {
        $productSku = ProductSku::create($request->all());

        return redirect()->route('frontend.product-skus.index');
    }

    public function edit(ProductSku $productSku)
    {
        abort_if(Gate::denies('product_sku_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = Product::all()->pluck('afa_model_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        $prod_dev_stages = ProductDevelopmentStage::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sizes = BedSizesByRegion::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $productSku->load('product', 'prod_dev_stage', 'size');

        return view('frontend.productSkus.edit', compact('products', 'prod_dev_stages', 'sizes', 'productSku'));
    }

    public function update(UpdateProductSkuRequest $request, ProductSku $productSku)
    {
        $productSku->update($request->all());

        return redirect()->route('frontend.product-skus.index');
    }

    public function show(ProductSku $productSku)
    {
        abort_if(Gate::denies('product_sku_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productSku->load('product', 'prod_dev_stage', 'size', 'skuPrices', 'productSkuComponentParts', 'relatedSkuDocuments');

        return view('frontend.productSkus.show', compact('productSku'));
    }

    public function destroy(ProductSku $productSku)
    {
        abort_if(Gate::denies('product_sku_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productSku->delete();

        return back();
    }

    public function massDestroy(MassDestroyProductSkuRequest $request)
    {
        ProductSku::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
