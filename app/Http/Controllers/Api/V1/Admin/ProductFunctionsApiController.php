<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductFunctionRequest;
use App\Http\Requests\UpdateProductFunctionRequest;
use App\Http\Resources\Admin\ProductFunctionResource;
use App\Models\ProductFunction;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductFunctionsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('product_function_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProductFunctionResource(ProductFunction::all());
    }

    public function store(StoreProductFunctionRequest $request)
    {
        $productFunction = ProductFunction::create($request->all());

        return (new ProductFunctionResource($productFunction))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ProductFunction $productFunction)
    {
        abort_if(Gate::denies('product_function_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProductFunctionResource($productFunction);
    }

    public function update(UpdateProductFunctionRequest $request, ProductFunction $productFunction)
    {
        $productFunction->update($request->all());

        return (new ProductFunctionResource($productFunction))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ProductFunction $productFunction)
    {
        abort_if(Gate::denies('product_function_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productFunction->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
