<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyStaffLevelRequest;
use App\Http\Requests\StoreStaffLevelRequest;
use App\Http\Requests\UpdateStaffLevelRequest;
use App\Models\StaffLevel;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class StaffLevelsController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('staff_level_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = StaffLevel::query()->select(sprintf('%s.*', (new StaffLevel())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'staff_level_show';
                $editGate = 'staff_level_edit';
                $deleteGate = 'staff_level_delete';
                $crudRoutePart = 'staff-levels';

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
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('list_order', function ($row) {
                return $row->list_order ? $row->list_order : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.staffLevels.index');
    }

    public function create()
    {
        abort_if(Gate::denies('staff_level_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.staffLevels.create');
    }

    public function store(StoreStaffLevelRequest $request)
    {
        $staffLevel = StaffLevel::create($request->all());

        return redirect()->route('admin.staff-levels.index');
    }

    public function edit(StaffLevel $staffLevel)
    {
        abort_if(Gate::denies('staff_level_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.staffLevels.edit', compact('staffLevel'));
    }

    public function update(UpdateStaffLevelRequest $request, StaffLevel $staffLevel)
    {
        $staffLevel->update($request->all());

        return redirect()->route('admin.staff-levels.index');
    }

    public function show(StaffLevel $staffLevel)
    {
        abort_if(Gate::denies('staff_level_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $staffLevel->load('staffLevelAfaStaffs');

        return view('admin.staffLevels.show', compact('staffLevel'));
    }

    public function destroy(StaffLevel $staffLevel)
    {
        abort_if(Gate::denies('staff_level_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $staffLevel->delete();

        return back();
    }

    public function massDestroy(MassDestroyStaffLevelRequest $request)
    {
        StaffLevel::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
