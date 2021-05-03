<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreBedSizeGroupRequest;
use App\Http\Requests\UpdateBedSizeGroupRequest;
use App\Http\Resources\Admin\BedSizeGroupResource;
use App\Models\BedSizeGroup;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BedSizeGroupsApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('bed_size_group_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BedSizeGroupResource(BedSizeGroup::with(['price_group'])->get());
    }

    public function store(StoreBedSizeGroupRequest $request)
    {
        $bedSizeGroup = BedSizeGroup::create($request->all());

        return (new BedSizeGroupResource($bedSizeGroup))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(BedSizeGroup $bedSizeGroup)
    {
        abort_if(Gate::denies('bed_size_group_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BedSizeGroupResource($bedSizeGroup->load(['price_group']));
    }

    public function update(UpdateBedSizeGroupRequest $request, BedSizeGroup $bedSizeGroup)
    {
        $bedSizeGroup->update($request->all());

        return (new BedSizeGroupResource($bedSizeGroup))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(BedSizeGroup $bedSizeGroup)
    {
        abort_if(Gate::denies('bed_size_group_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bedSizeGroup->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
