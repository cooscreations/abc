<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreRawMaterialTypeRequest;
use App\Http\Requests\UpdateRawMaterialTypeRequest;
use App\Http\Resources\Admin\RawMaterialTypeResource;
use App\Models\RawMaterialType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RawMaterialTypesApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('raw_material_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RawMaterialTypeResource(RawMaterialType::all());
    }

    public function store(StoreRawMaterialTypeRequest $request)
    {
        $rawMaterialType = RawMaterialType::create($request->all());

        return (new RawMaterialTypeResource($rawMaterialType))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(RawMaterialType $rawMaterialType)
    {
        abort_if(Gate::denies('raw_material_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RawMaterialTypeResource($rawMaterialType);
    }

    public function update(UpdateRawMaterialTypeRequest $request, RawMaterialType $rawMaterialType)
    {
        $rawMaterialType->update($request->all());

        return (new RawMaterialTypeResource($rawMaterialType))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(RawMaterialType $rawMaterialType)
    {
        abort_if(Gate::denies('raw_material_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rawMaterialType->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
