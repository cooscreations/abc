<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyFabricRequest;
use App\Http\Requests\StoreFabricRequest;
use App\Http\Requests\UpdateFabricRequest;
use App\Models\Fabric;
use App\Models\FabricGroup;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class FabricController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('fabric_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Fabric::with(['fabric_group'])->select(sprintf('%s.*', (new Fabric())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'fabric_show';
                $editGate = 'fabric_edit';
                $deleteGate = 'fabric_delete';
                $crudRoutePart = 'fabrics';

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
            $table->addColumn('fabric_group_name', function ($row) {
                return $row->fabric_group ? $row->fabric_group->name : '';
            });

            $table->editColumn('fabric_code', function ($row) {
                return $row->fabric_code ? $row->fabric_code : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'fabric_group']);

            return $table->make(true);
        }

        $fabric_groups = FabricGroup::get();

        return view('admin.fabrics.index', compact('fabric_groups'));
    }

    public function create()
    {
        abort_if(Gate::denies('fabric_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fabric_groups = FabricGroup::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.fabrics.create', compact('fabric_groups'));
    }

    public function store(StoreFabricRequest $request)
    {
        $fabric = Fabric::create($request->all());

        return redirect()->route('admin.fabrics.index');
    }

    public function edit(Fabric $fabric)
    {
        abort_if(Gate::denies('fabric_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fabric_groups = FabricGroup::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $fabric->load('fabric_group');

        return view('admin.fabrics.edit', compact('fabric_groups', 'fabric'));
    }

    public function update(UpdateFabricRequest $request, Fabric $fabric)
    {
        $fabric->update($request->all());

        return redirect()->route('admin.fabrics.index');
    }

    public function show(Fabric $fabric)
    {
        abort_if(Gate::denies('fabric_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fabric->load('fabric_group', 'fabricFabricNicknames');

        return view('admin.fabrics.show', compact('fabric'));
    }

    public function destroy(Fabric $fabric)
    {
        abort_if(Gate::denies('fabric_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fabric->delete();

        return back();
    }

    public function massDestroy(MassDestroyFabricRequest $request)
    {
        Fabric::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
