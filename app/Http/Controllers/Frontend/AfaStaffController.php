<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyAfaStaffRequest;
use App\Http\Requests\StoreAfaStaffRequest;
use App\Http\Requests\UpdateAfaStaffRequest;
use App\Models\AfaStaff;
use App\Models\Department;
use App\Models\StaffLevel;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AfaStaffController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('afa_staff_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $afaStaffs = AfaStaff::with(['user', 'staff_level', 'reports_to', 'department'])->get();

        $users = User::get();

        $staff_levels = StaffLevel::get();

        $departments = Department::get();

        return view('frontend.afaStaffs.index', compact('afaStaffs', 'users', 'staff_levels', 'departments'));
    }

    public function create()
    {
        abort_if(Gate::denies('afa_staff_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $staff_levels = StaffLevel::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $reports_tos = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $departments = Department::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.afaStaffs.create', compact('users', 'staff_levels', 'reports_tos', 'departments'));
    }

    public function store(StoreAfaStaffRequest $request)
    {
        $afaStaff = AfaStaff::create($request->all());

        return redirect()->route('frontend.afa-staffs.index');
    }

    public function edit(AfaStaff $afaStaff)
    {
        abort_if(Gate::denies('afa_staff_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $staff_levels = StaffLevel::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $reports_tos = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $departments = Department::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $afaStaff->load('user', 'staff_level', 'reports_to', 'department');

        return view('frontend.afaStaffs.edit', compact('users', 'staff_levels', 'reports_tos', 'departments', 'afaStaff'));
    }

    public function update(UpdateAfaStaffRequest $request, AfaStaff $afaStaff)
    {
        $afaStaff->update($request->all());

        return redirect()->route('frontend.afa-staffs.index');
    }

    public function show(AfaStaff $afaStaff)
    {
        abort_if(Gate::denies('afa_staff_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $afaStaff->load('user', 'staff_level', 'reports_to', 'department', 'inspectorNameInspections');

        return view('frontend.afaStaffs.show', compact('afaStaff'));
    }

    public function destroy(AfaStaff $afaStaff)
    {
        abort_if(Gate::denies('afa_staff_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $afaStaff->delete();

        return back();
    }

    public function massDestroy(MassDestroyAfaStaffRequest $request)
    {
        AfaStaff::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
