<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyProductTypeRequest;
use App\Http\Requests\StoreProductTypeRequest;
use App\Http\Requests\UpdateProductTypeRequest;
use App\Models\ProductType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductTypeController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('product_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productTypes = ProductType::all();

        return view('frontend.productTypes.index', compact('productTypes'));
    }

    public function create()
    {
        abort_if(Gate::denies('product_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.productTypes.create');
    }

    public function store(StoreProductTypeRequest $request)
    {
        $productType = ProductType::create($request->all());

        return redirect()->route('frontend.product-types.index');
    }

    public function edit(ProductType $productType)
    {
        abort_if(Gate::denies('product_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.productTypes.edit', compact('productType'));
    }

    public function update(UpdateProductTypeRequest $request, ProductType $productType)
    {
        $productType->update($request->all());

        return redirect()->route('frontend.product-types.index');
    }

    public function show(ProductType $productType)
    {
        abort_if(Gate::denies('product_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productType->load('productTypeProductCodeGroups', 'client1ProductTypeSupplierAudits');

        return view('frontend.productTypes.show', compact('productType'));
    }

    public function destroy(ProductType $productType)
    {
        abort_if(Gate::denies('product_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productType->delete();

        return back();
    }

    public function massDestroy(MassDestroyProductTypeRequest $request)
    {
        ProductType::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
