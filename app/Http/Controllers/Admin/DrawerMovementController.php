<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyDrawerMovementRequest;
use App\Http\Requests\StoreDrawerMovementRequest;
use App\Http\Requests\UpdateDrawerMovementRequest;
use App\Models\DrawerMovement;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class DrawerMovementController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('drawer_movement_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = DrawerMovement::query()->select(sprintf('%s.*', (new DrawerMovement())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'drawer_movement_show';
                $editGate = 'drawer_movement_edit';
                $deleteGate = 'drawer_movement_delete';
                $crudRoutePart = 'drawer-movements';

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

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.drawerMovements.index');
    }

    public function create()
    {
        abort_if(Gate::denies('drawer_movement_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.drawerMovements.create');
    }

    public function store(StoreDrawerMovementRequest $request)
    {
        $drawerMovement = DrawerMovement::create($request->all());

        return redirect()->route('admin.drawer-movements.index');
    }

    public function edit(DrawerMovement $drawerMovement)
    {
        abort_if(Gate::denies('drawer_movement_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.drawerMovements.edit', compact('drawerMovement'));
    }

    public function update(UpdateDrawerMovementRequest $request, DrawerMovement $drawerMovement)
    {
        $drawerMovement->update($request->all());

        return redirect()->route('admin.drawer-movements.index');
    }

    public function show(DrawerMovement $drawerMovement)
    {
        abort_if(Gate::denies('drawer_movement_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $drawerMovement->load('defaultDrawerMovementProducts');

        return view('admin.drawerMovements.show', compact('drawerMovement'));
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
