<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAfaStaffRequest;
use App\Http\Requests\UpdateAfaStaffRequest;
use App\Http\Resources\Admin\AfaStaffResource;
use App\Models\AfaStaff;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AfaStaffApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('afa_staff_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AfaStaffResource(AfaStaff::with(['user', 'staff_level', 'reports_to', 'department'])->get());
    }

    public function store(StoreAfaStaffRequest $request)
    {
        $afaStaff = AfaStaff::create($request->all());

        return (new AfaStaffResource($afaStaff))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(AfaStaff $afaStaff)
    {
        abort_if(Gate::denies('afa_staff_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AfaStaffResource($afaStaff->load(['user', 'staff_level', 'reports_to', 'department']));
    }

    public function update(UpdateAfaStaffRequest $request, AfaStaff $afaStaff)
    {
        $afaStaff->update($request->all());

        return (new AfaStaffResource($afaStaff))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(AfaStaff $afaStaff)
    {
        abort_if(Gate::denies('afa_staff_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $afaStaff->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
