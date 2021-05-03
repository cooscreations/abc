<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyComplaintStatusRequest;
use App\Http\Requests\StoreComplaintStatusRequest;
use App\Http\Requests\UpdateComplaintStatusRequest;
use App\Models\ComplaintStatus;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ComplaintStatusController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('complaint_status_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $complaintStatuses = ComplaintStatus::all();

        return view('frontend.complaintStatuses.index', compact('complaintStatuses'));
    }

    public function create()
    {
        abort_if(Gate::denies('complaint_status_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.complaintStatuses.create');
    }

    public function store(StoreComplaintStatusRequest $request)
    {
        $complaintStatus = ComplaintStatus::create($request->all());

        return redirect()->route('frontend.complaint-statuses.index');
    }

    public function edit(ComplaintStatus $complaintStatus)
    {
        abort_if(Gate::denies('complaint_status_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.complaintStatuses.edit', compact('complaintStatus'));
    }

    public function update(UpdateComplaintStatusRequest $request, ComplaintStatus $complaintStatus)
    {
        $complaintStatus->update($request->all());

        return redirect()->route('frontend.complaint-statuses.index');
    }

    public function show(ComplaintStatus $complaintStatus)
    {
        abort_if(Gate::denies('complaint_status_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.complaintStatuses.show', compact('complaintStatus'));
    }

    public function destroy(ComplaintStatus $complaintStatus)
    {
        abort_if(Gate::denies('complaint_status_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $complaintStatus->delete();

        return back();
    }

    public function massDestroy(MassDestroyComplaintStatusRequest $request)
    {
        ComplaintStatus::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
