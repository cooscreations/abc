<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInspectionStatusRequest;
use App\Http\Requests\UpdateInspectionStatusRequest;
use App\Http\Resources\Admin\InspectionStatusResource;
use App\Models\InspectionStatus;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class InspectionStatusApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('inspection_status_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new InspectionStatusResource(InspectionStatus::all());
    }

    public function store(StoreInspectionStatusRequest $request)
    {
        $inspectionStatus = InspectionStatus::create($request->all());

        return (new InspectionStatusResource($inspectionStatus))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(InspectionStatus $inspectionStatus)
    {
        abort_if(Gate::denies('inspection_status_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new InspectionStatusResource($inspectionStatus);
    }

    public function update(UpdateInspectionStatusRequest $request, InspectionStatus $inspectionStatus)
    {
        $inspectionStatus->update($request->all());

        return (new InspectionStatusResource($inspectionStatus))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(InspectionStatus $inspectionStatus)
    {
        abort_if(Gate::denies('inspection_status_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $inspectionStatus->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
