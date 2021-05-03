<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyInspectionStatusRequest;
use App\Http\Requests\StoreInspectionStatusRequest;
use App\Http\Requests\UpdateInspectionStatusRequest;
use App\Models\InspectionStatus;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class InspectionStatusController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('inspection_status_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $inspectionStatuses = InspectionStatus::all();

        return view('frontend.inspectionStatuses.index', compact('inspectionStatuses'));
    }

    public function create()
    {
        abort_if(Gate::denies('inspection_status_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.inspectionStatuses.create');
    }

    public function store(StoreInspectionStatusRequest $request)
    {
        $inspectionStatus = InspectionStatus::create($request->all());

        return redirect()->route('frontend.inspection-statuses.index');
    }

    public function edit(InspectionStatus $inspectionStatus)
    {
        abort_if(Gate::denies('inspection_status_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.inspectionStatuses.edit', compact('inspectionStatus'));
    }

    public function update(UpdateInspectionStatusRequest $request, InspectionStatus $inspectionStatus)
    {
        $inspectionStatus->update($request->all());

        return redirect()->route('frontend.inspection-statuses.index');
    }

    public function show(InspectionStatus $inspectionStatus)
    {
        abort_if(Gate::denies('inspection_status_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $inspectionStatus->load('qcStatusInspections');

        return view('frontend.inspectionStatuses.show', compact('inspectionStatus'));
    }

    public function destroy(InspectionStatus $inspectionStatus)
    {
        abort_if(Gate::denies('inspection_status_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $inspectionStatus->delete();

        return back();
    }

    public function massDestroy(MassDestroyInspectionStatusRequest $request)
    {
        InspectionStatus::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
