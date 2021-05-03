<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StorePackagingTypeRequest;
use App\Http\Requests\UpdatePackagingTypeRequest;
use App\Http\Resources\Admin\PackagingTypeResource;
use App\Models\PackagingType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PackagingTypesApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('packaging_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PackagingTypeResource(PackagingType::with(['primary_material'])->get());
    }

    public function store(StorePackagingTypeRequest $request)
    {
        $packagingType = PackagingType::create($request->all());

        return (new PackagingTypeResource($packagingType))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(PackagingType $packagingType)
    {
        abort_if(Gate::denies('packaging_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PackagingTypeResource($packagingType->load(['primary_material']));
    }

    public function update(UpdatePackagingTypeRequest $request, PackagingType $packagingType)
    {
        $packagingType->update($request->all());

        return (new PackagingTypeResource($packagingType))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(PackagingType $packagingType)
    {
        abort_if(Gate::denies('packaging_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $packagingType->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
