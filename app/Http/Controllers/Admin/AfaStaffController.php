<?php

namespace App\Http\Controllers\Admin;

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
use Yajra\DataTables\Facades\DataTables;

class AfaStaffController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('afa_staff_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = AfaStaff::with(['user', 'staff_level', 'reports_to', 'department'])->select(sprintf('%s.*', (new AfaStaff())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'afa_staff_show';
                $editGate = 'afa_staff_edit';
                $deleteGate = 'afa_staff_delete';
                $crudRoutePart = 'afa-staffs';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('full_name', function ($row) {
                return $row->full_name ? $row->full_name : '';
            });
            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->addColumn('staff_level_name', function ($row) {
                return $row->staff_level ? $row->staff_level->name : '';
            });

            $table->addColumn('department_name', function ($row) {
                return $row->department ? $row->department->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user', 'staff_level', 'department']);

            return $table->make(true);
        }

        $users        = User::get();
        $staff_levels = StaffLevel::get();
        $departments  = Department::get();

        return view('admin.afaStaffs.index', compact('users', 'staff_levels', 'departments'));
    }

    public function create()
    {
        abort_if(Gate::denies('afa_staff_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $staff_levels = StaffLevel::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $reports_tos = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $departments = Department::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.afaStaffs.create', compact('users', 'staff_levels', 'reports_tos', 'departments'));
    }

    public function store(StoreAfaStaffRequest $request)
    {
        $afaStaff = AfaStaff::create($request->all());

        return redirect()->route('admin.afa-staffs.index');
    }

    public function edit(AfaStaff $afaStaff)
    {
        abort_if(Gate::denies('afa_staff_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $staff_levels = StaffLevel::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $reports_tos = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $departments = Department::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $afaStaff->load('user', 'staff_level', 'reports_to', 'department');

        return view('admin.afaStaffs.edit', compact('users', 'staff_levels', 'reports_tos', 'departments', 'afaStaff'));
    }

    public function update(UpdateAfaStaffRequest $request, AfaStaff $afaStaff)
    {
        $afaStaff->update($request->all());

        return redirect()->route('admin.afa-staffs.index');
    }

    public function show(AfaStaff $afaStaff)
    {
        abort_if(Gate::denies('afa_staff_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $afaStaff->load('user', 'staff_level', 'reports_to', 'department', 'inspectorNameInspections', 'orderFollowerOrders', 'orderFollowerInspections', 'qualityControlStaffOrders', 'additionalQCsInspections');

        return view('admin.afaStaffs.show', compact('afaStaff'));
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
