<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBedSizesByRegionRequest;
use App\Http\Requests\UpdateBedSizesByRegionRequest;
use App\Http\Resources\Admin\BedSizesByRegionResource;
use App\Models\BedSizesByRegion;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BedSizesByRegionApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('bed_sizes_by_region_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BedSizesByRegionResource(BedSizesByRegion::with(['world_region', 'size_name', 'base_style', 'related_size_groups'])->get());
    }

    public function store(StoreBedSizesByRegionRequest $request)
    {
        $bedSizesByRegion = BedSizesByRegion::create($request->all());
        $bedSizesByRegion->related_size_groups()->sync($request->input('related_size_groups', []));

        return (new BedSizesByRegionResource($bedSizesByRegion))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(BedSizesByRegion $bedSizesByRegion)
    {
        abort_if(Gate::denies('bed_sizes_by_region_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BedSizesByRegionResource($bedSizesByRegion->load(['world_region', 'size_name', 'base_style', 'related_size_groups']));
    }

    public function update(UpdateBedSizesByRegionRequest $request, BedSizesByRegion $bedSizesByRegion)
    {
        $bedSizesByRegion->update($request->all());
        $bedSizesByRegion->related_size_groups()->sync($request->input('related_size_groups', []));

        return (new BedSizesByRegionResource($bedSizesByRegion))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(BedSizesByRegion $bedSizesByRegion)
    {
        abort_if(Gate::denies('bed_sizes_by_region_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bedSizesByRegion->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
