<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyStaffLevelRequest;
use App\Http\Requests\StoreStaffLevelRequest;
use App\Http\Requests\UpdateStaffLevelRequest;
use App\Models\StaffLevel;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StaffLevelsController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('staff_level_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $staffLevels = StaffLevel::all();

        return view('frontend.staffLevels.index', compact('staffLevels'));
    }

    public function create()
    {
        abort_if(Gate::denies('staff_level_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.staffLevels.create');
    }

    public function store(StoreStaffLevelRequest $request)
    {
        $staffLevel = StaffLevel::create($request->all());

        return redirect()->route('frontend.staff-levels.index');
    }

    public function edit(StaffLevel $staffLevel)
    {
        abort_if(Gate::denies('staff_level_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.staffLevels.edit', compact('staffLevel'));
    }

    public function update(UpdateStaffLevelRequest $request, StaffLevel $staffLevel)
    {
        $staffLevel->update($request->all());

        return redirect()->route('frontend.staff-levels.index');
    }

    public function show(StaffLevel $staffLevel)
    {
        abort_if(Gate::denies('staff_level_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $staffLevel->load('staffLevelAfaStaffs');

        return view('frontend.staffLevels.show', compact('staffLevel'));
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
