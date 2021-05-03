<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInspectionRequest;
use App\Http\Requests\UpdateInspectionRequest;
use App\Http\Resources\Admin\InspectionResource;
use App\Models\Inspection;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class InspectionsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('inspection_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new InspectionResource(Inspection::with(['order', 'inspector_name', 'customer', 'order_follower', 'supplier', 'order_item', 'qc_status', 'additional_q_cs'])->get());
    }

    public function store(StoreInspectionRequest $request)
    {
        $inspection = Inspection::create($request->all());
        $inspection->additional_q_cs()->sync($request->input('additional_q_cs', []));

        return (new InspectionResource($inspection))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Inspection $inspection)
    {
        abort_if(Gate::denies('inspection_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new InspectionResource($inspection->load(['order', 'inspector_name', 'customer', 'order_follower', 'supplier', 'order_item', 'qc_status', 'additional_q_cs']));
    }

    public function update(UpdateInspectionRequest $request, Inspection $inspection)
    {
        $inspection->update($request->all());
        $inspection->additional_q_cs()->sync($request->input('additional_q_cs', []));

        return (new InspectionResource($inspection))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Inspection $inspection)
    {
        abort_if(Gate::denies('inspection_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $inspection->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
