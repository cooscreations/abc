<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreComplaintRequest;
use App\Http\Requests\UpdateComplaintRequest;
use App\Http\Resources\Admin\ComplaintResource;
use App\Models\Complaint;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ComplaintsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('complaint_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ComplaintResource(Complaint::all());
    }

    public function store(StoreComplaintRequest $request)
    {
        $complaint = Complaint::create($request->all());

        return (new ComplaintResource($complaint))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Complaint $complaint)
    {
        abort_if(Gate::denies('complaint_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ComplaintResource($complaint);
    }

    public function update(UpdateComplaintRequest $request, Complaint $complaint)
    {
        $complaint->update($request->all());

        return (new ComplaintResource($complaint))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Complaint $complaint)
    {
        abort_if(Gate::denies('complaint_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $complaint->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
