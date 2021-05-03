<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStaffLevelRequest;
use App\Http\Requests\UpdateStaffLevelRequest;
use App\Http\Resources\Admin\StaffLevelResource;
use App\Models\StaffLevel;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StaffLevelsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('staff_level_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new StaffLevelResource(StaffLevel::all());
    }

    public function store(StoreStaffLevelRequest $request)
    {
        $staffLevel = StaffLevel::create($request->all());

        return (new StaffLevelResource($staffLevel))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(StaffLevel $staffLevel)
    {
        abort_if(Gate::denies('staff_level_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new StaffLevelResource($staffLevel);
    }

    public function update(UpdateStaffLevelRequest $request, StaffLevel $staffLevel)
    {
        $staffLevel->update($request->all());

        return (new StaffLevelResource($staffLevel))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(StaffLevel $staffLevel)
    {
        abort_if(Gate::denies('staff_level_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $staffLevel->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
