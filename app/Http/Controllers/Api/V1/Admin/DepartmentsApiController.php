<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use App\Http\Resources\Admin\DepartmentResource;
use App\Models\Department;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DepartmentsApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('department_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DepartmentResource(Department::with(['manager'])->get());
    }

    public function store(StoreDepartmentRequest $request)
    {
        $department = Department::create($request->all());

        if ($request->input('icon', false)) {
            $department->addMedia(storage_path('tmp/uploads/' . basename($request->input('icon'))))->toMediaCollection('icon');
        }

        return (new DepartmentResource($department))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Department $department)
    {
        abort_if(Gate::denies('department_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DepartmentResource($department->load(['manager']));
    }

    public function update(UpdateDepartmentRequest $request, Department $department)
    {
        $department->update($request->all());

        if ($request->input('icon', false)) {
            if (!$department->icon || $request->input('icon') !== $department->icon->file_name) {
                if ($department->icon) {
                    $department->icon->delete();
                }
                $department->addMedia(storage_path('tmp/uploads/' . basename($request->input('icon'))))->toMediaCollection('icon');
            }
        } elseif ($department->icon) {
            $department->icon->delete();
        }

        return (new DepartmentResource($department))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Department $department)
    {
        abort_if(Gate::denies('department_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $department->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
