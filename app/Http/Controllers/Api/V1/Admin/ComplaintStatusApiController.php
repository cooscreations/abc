<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreComplaintStatusRequest;
use App\Http\Requests\UpdateComplaintStatusRequest;
use App\Http\Resources\Admin\ComplaintStatusResource;
use App\Models\ComplaintStatus;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ComplaintStatusApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('complaint_status_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ComplaintStatusResource(ComplaintStatus::all());
    }

    public function store(StoreComplaintStatusRequest $request)
    {
        $complaintStatus = ComplaintStatus::create($request->all());

        return (new ComplaintStatusResource($complaintStatus))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ComplaintStatus $complaintStatus)
    {
        abort_if(Gate::denies('complaint_status_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ComplaintStatusResource($complaintStatus);
    }

    public function update(UpdateComplaintStatusRequest $request, ComplaintStatus $complaintStatus)
    {
        $complaintStatus->update($request->all());

        return (new ComplaintStatusResource($complaintStatus))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ComplaintStatus $complaintStatus)
    {
        abort_if(Gate::denies('complaint_status_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $complaintStatus->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
