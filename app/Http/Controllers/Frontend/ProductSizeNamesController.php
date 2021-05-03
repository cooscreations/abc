<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyProductSizeNameRequest;
use App\Http\Requests\StoreProductSizeNameRequest;
use App\Http\Requests\UpdateProductSizeNameRequest;
use App\Models\ProductSizeName;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductSizeNamesController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('product_size_name_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productSizeNames = ProductSizeName::all();

        return view('frontend.productSizeNames.index', compact('productSizeNames'));
    }

    public function create()
    {
        abort_if(Gate::denies('product_size_name_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.productSizeNames.create');
    }

    public function store(StoreProductSizeNameRequest $request)
    {
        $productSizeName = ProductSizeName::create($request->all());

        return redirect()->route('frontend.product-size-names.index');
    }

    public function edit(ProductSizeName $productSizeName)
    {
        abort_if(Gate::denies('product_size_name_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.productSizeNames.edit', compact('productSizeName'));
    }

    public function update(UpdateProductSizeNameRequest $request, ProductSizeName $productSizeName)
    {
        $productSizeName->update($request->all());

        return redirect()->route('frontend.product-size-names.index');
    }

    public function show(ProductSizeName $productSizeName)
    {
        abort_if(Gate::denies('product_size_name_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productSizeName->load('sizeNameBedSizesByRegions');

        return view('frontend.productSizeNames.show', compact('productSizeName'));
    }

    public function destroy(ProductSizeName $productSizeName)
    {
        abort_if(Gate::denies('product_size_name_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productSizeName->delete();

        return back();
    }

    public function massDestroy(MassDestroyProductSizeNameRequest $request)
    {
        ProductSizeName::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
