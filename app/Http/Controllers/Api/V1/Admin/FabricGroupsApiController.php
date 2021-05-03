<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreFabricGroupRequest;
use App\Http\Requests\UpdateFabricGroupRequest;
use App\Http\Resources\Admin\FabricGroupResource;
use App\Models\FabricGroup;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FabricGroupsApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('fabric_group_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FabricGroupResource(FabricGroup::with(['primary_supplier'])->get());
    }

    public function store(StoreFabricGroupRequest $request)
    {
        $fabricGroup = FabricGroup::create($request->all());

        return (new FabricGroupResource($fabricGroup))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(FabricGroup $fabricGroup)
    {
        abort_if(Gate::denies('fabric_group_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FabricGroupResource($fabricGroup->load(['primary_supplier']));
    }

    public function update(UpdateFabricGroupRequest $request, FabricGroup $fabricGroup)
    {
        $fabricGroup->update($request->all());

        return (new FabricGroupResource($fabricGroup))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(FabricGroup $fabricGroup)
    {
        abort_if(Gate::denies('fabric_group_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fabricGroup->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
