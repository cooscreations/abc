<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyProductFunctionRequest;
use App\Http\Requests\StoreProductFunctionRequest;
use App\Http\Requests\UpdateProductFunctionRequest;
use App\Models\ProductFunction;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductFunctionsController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('product_function_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productFunctions = ProductFunction::all();

        return view('frontend.productFunctions.index', compact('productFunctions'));
    }

    public function create()
    {
        abort_if(Gate::denies('product_function_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.productFunctions.create');
    }

    public function store(StoreProductFunctionRequest $request)
    {
        $productFunction = ProductFunction::create($request->all());

        return redirect()->route('frontend.product-functions.index');
    }

    public function edit(ProductFunction $productFunction)
    {
        abort_if(Gate::denies('product_function_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.productFunctions.edit', compact('productFunction'));
    }

    public function update(UpdateProductFunctionRequest $request, ProductFunction $productFunction)
    {
        $productFunction->update($request->all());

        return redirect()->route('frontend.product-functions.index');
    }

    public function show(ProductFunction $productFunction)
    {
        abort_if(Gate::denies('product_function_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productFunction->load('defaultFunctionProducts', 'productFunctionProductCodeGroups');

        return view('frontend.productFunctions.show', compact('productFunction'));
    }

    public function destroy(ProductFunction $productFunction)
    {
        abort_if(Gate::denies('product_function_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productFunction->delete();

        return back();
    }

    public function massDestroy(MassDestroyProductFunctionRequest $request)
    {
        ProductFunction::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
