<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreWorldRegionRequest;
use App\Http\Requests\UpdateWorldRegionRequest;
use App\Http\Resources\Admin\WorldRegionResource;
use App\Models\WorldRegion;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WorldRegionsApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('world_region_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new WorldRegionResource(WorldRegion::all());
    }

    public function store(StoreWorldRegionRequest $request)
    {
        $worldRegion = WorldRegion::create($request->all());

        return (new WorldRegionResource($worldRegion))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(WorldRegion $worldRegion)
    {
        abort_if(Gate::denies('world_region_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new WorldRegionResource($worldRegion);
    }

    public function update(UpdateWorldRegionRequest $request, WorldRegion $worldRegion)
    {
        $worldRegion->update($request->all());

        return (new WorldRegionResource($worldRegion))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(WorldRegion $worldRegion)
    {
        abort_if(Gate::denies('world_region_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $worldRegion->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
