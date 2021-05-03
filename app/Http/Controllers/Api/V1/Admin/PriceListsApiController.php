<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePriceListRequest;
use App\Http\Requests\UpdatePriceListRequest;
use App\Http\Resources\Admin\PriceListResource;
use App\Models\PriceList;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PriceListsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('price_list_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PriceListResource(PriceList::with(['type', 'group'])->get());
    }

    public function store(StorePriceListRequest $request)
    {
        $priceList = PriceList::create($request->all());

        return (new PriceListResource($priceList))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(PriceList $priceList)
    {
        abort_if(Gate::denies('price_list_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PriceListResource($priceList->load(['type', 'group']));
    }

    public function update(UpdatePriceListRequest $request, PriceList $priceList)
    {
        $priceList->update($request->all());

        return (new PriceListResource($priceList))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(PriceList $priceList)
    {
        abort_if(Gate::denies('price_list_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $priceList->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
