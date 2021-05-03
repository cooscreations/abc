<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePriceListTypeRequest;
use App\Http\Requests\UpdatePriceListTypeRequest;
use App\Http\Resources\Admin\PriceListTypeResource;
use App\Models\PriceListType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PriceListTypesApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('price_list_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PriceListTypeResource(PriceListType::all());
    }

    public function store(StorePriceListTypeRequest $request)
    {
        $priceListType = PriceListType::create($request->all());

        return (new PriceListTypeResource($priceListType))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(PriceListType $priceListType)
    {
        abort_if(Gate::denies('price_list_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PriceListTypeResource($priceListType);
    }

    public function update(UpdatePriceListTypeRequest $request, PriceListType $priceListType)
    {
        $priceListType->update($request->all());

        return (new PriceListTypeResource($priceListType))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(PriceListType $priceListType)
    {
        abort_if(Gate::denies('price_list_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $priceListType->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
