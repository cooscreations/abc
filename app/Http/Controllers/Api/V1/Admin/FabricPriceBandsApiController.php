<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreFabricPriceBandRequest;
use App\Http\Requests\UpdateFabricPriceBandRequest;
use App\Http\Resources\Admin\FabricPriceBandResource;
use App\Models\FabricPriceBand;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FabricPriceBandsApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('fabric_price_band_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FabricPriceBandResource(FabricPriceBand::all());
    }

    public function store(StoreFabricPriceBandRequest $request)
    {
        $fabricPriceBand = FabricPriceBand::create($request->all());

        return (new FabricPriceBandResource($fabricPriceBand))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(FabricPriceBand $fabricPriceBand)
    {
        abort_if(Gate::denies('fabric_price_band_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FabricPriceBandResource($fabricPriceBand);
    }

    public function update(UpdateFabricPriceBandRequest $request, FabricPriceBand $fabricPriceBand)
    {
        $fabricPriceBand->update($request->all());

        return (new FabricPriceBandResource($fabricPriceBand))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(FabricPriceBand $fabricPriceBand)
    {
        abort_if(Gate::denies('fabric_price_band_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fabricPriceBand->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
