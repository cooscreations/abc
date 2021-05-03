<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyEquipmentTypeRequest;
use App\Http\Requests\StoreEquipmentTypeRequest;
use App\Http\Requests\UpdateEquipmentTypeRequest;
use App\Models\EquipmentType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class EquipmentTypeController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('equipment_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = EquipmentType::query()->select(sprintf('%s.*', (new EquipmentType())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'equipment_type_show';
                $editGate = 'equipment_type_edit';
                $deleteGate = 'equipment_type_delete';
                $crudRoutePart = 'equipment-types';

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

        return view('admin.equipmentTypes.index');
    }

    public function create()
    {
        abort_if(Gate::denies('equipment_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.equipmentTypes.create');
    }

    public function store(StoreEquipmentTypeRequest $request)
    {
        $equipmentType = EquipmentType::create($request->all());

        return redirect()->route('admin.equipment-types.index');
    }

    public function edit(EquipmentType $equipmentType)
    {
        abort_if(Gate::denies('equipment_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.equipmentTypes.edit', compact('equipmentType'));
    }

    public function update(UpdateEquipmentTypeRequest $request, EquipmentType $equipmentType)
    {
        $equipmentType->update($request->all());

        return redirect()->route('admin.equipment-types.index');
    }

    public function show(EquipmentType $equipmentType)
    {
        abort_if(Gate::denies('equipment_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $equipmentType->load('equipmentTypeEquipment');

        return view('admin.equipmentTypes.show', compact('equipmentType'));
    }

    public function destroy(EquipmentType $equipmentType)
    {
        abort_if(Gate::denies('equipment_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $equipmentType->delete();

        return back();
    }

    public function massDestroy(MassDestroyEquipmentTypeRequest $request)
    {
        EquipmentType::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
