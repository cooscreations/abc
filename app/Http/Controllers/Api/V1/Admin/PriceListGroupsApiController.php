<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePriceListGroupRequest;
use App\Http\Requests\UpdatePriceListGroupRequest;
use App\Http\Resources\Admin\PriceListGroupResource;
use App\Models\PriceListGroup;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PriceListGroupsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('price_list_group_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PriceListGroupResource(PriceListGroup::all());
    }

    public function store(StorePriceListGroupRequest $request)
    {
        $priceListGroup = PriceListGroup::create($request->all());

        return (new PriceListGroupResource($priceListGroup))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(PriceListGroup $priceListGroup)
    {
        abort_if(Gate::denies('price_list_group_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PriceListGroupResource($priceListGroup);
    }

    public function update(UpdatePriceListGroupRequest $request, PriceListGroup $priceListGroup)
    {
        $priceListGroup->update($request->all());

        return (new PriceListGroupResource($priceListGroup))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(PriceListGroup $priceListGroup)
    {
        abort_if(Gate::denies('price_list_group_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $priceListGroup->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
