<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyDrawerMovementRequest;
use App\Http\Requests\StoreDrawerMovementRequest;
use App\Http\Requests\UpdateDrawerMovementRequest;
use App\Models\DrawerMovement;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DrawerMovementController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('drawer_movement_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $drawerMovements = DrawerMovement::all();

        return view('frontend.drawerMovements.index', compact('drawerMovements'));
    }

    public function create()
    {
        abort_if(Gate::denies('drawer_movement_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.drawerMovements.create');
    }

    public function store(StoreDrawerMovementRequest $request)
    {
        $drawerMovement = DrawerMovement::create($request->all());

        return redirect()->route('frontend.drawer-movements.index');
    }

    public function edit(DrawerMovement $drawerMovement)
    {
        abort_if(Gate::denies('drawer_movement_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.drawerMovements.edit', compact('drawerMovement'));
    }

    public function update(UpdateDrawerMovementRequest $request, DrawerMovement $drawerMovement)
    {
        $drawerMovement->update($request->all());

        return redirect()->route('frontend.drawer-movements.index');
    }

    public function show(DrawerMovement $drawerMovement)
    {
        abort_if(Gate::denies('drawer_movement_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $drawerMovement->load('defaultDrawerMovementProducts');

        return view('frontend.drawerMovements.show', compact('drawerMovement'));
    }

    public function destroy(DrawerMovement $drawerMovement)
    {
        abort_if(Gate::denies('drawer_movement_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $drawerMovement->delete();

        return back();
    }

    public function massDestroy(MassDestroyDrawerMovementRequest $request)
    {
        DrawerMovement::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
