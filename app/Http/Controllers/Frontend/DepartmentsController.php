<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyDepartmentRequest;
use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use App\Models\Department;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class DepartmentsController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('department_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $departments = Department::with(['manager', 'media'])->get();

        $users = User::get();

        return view('frontend.departments.index', compact('departments', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('department_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $managers = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.departments.create', compact('managers'));
    }

    public function store(StoreDepartmentRequest $request)
    {
        $department = Department::create($request->all());

        if ($request->input('icon', false)) {
            $department->addMedia(storage_path('tmp/uploads/' . basename($request->input('icon'))))->toMediaCollection('icon');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $department->id]);
        }

        return redirect()->route('frontend.departments.index');
    }

    public function edit(Department $department)
    {
        abort_if(Gate::denies('department_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $managers = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $department->load('manager');

        return view('frontend.departments.edit', compact('managers', 'department'));
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

        return redirect()->route('frontend.departments.index');
    }

    public function show(Department $department)
    {
        abort_if(Gate::denies('department_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $department->load('manager', 'departmentAfaStaffs');

        return view('frontend.departments.show', compact('department'));
    }

    public function destroy(Department $department)
    {
        abort_if(Gate::denies('department_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $department->delete();

        return back();
    }

    public function massDestroy(MassDestroyDepartmentRequest $request)
    {
        Department::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('department_create') && Gate::denies('department_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Department();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
