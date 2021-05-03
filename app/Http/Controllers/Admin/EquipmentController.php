<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyEquipmentRequest;
use App\Http\Requests\StoreEquipmentRequest;
use App\Http\Requests\UpdateEquipmentRequest;
use App\Models\ContactCompany;
use App\Models\Equipment;
use App\Models\EquipmentType;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class EquipmentController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('equipment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Equipment::with(['manufacturer', 'equipment_type'])->select(sprintf('%s.*', (new Equipment())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'equipment_show';
                $editGate = 'equipment_edit';
                $deleteGate = 'equipment_delete';
                $crudRoutePart = 'equipment';

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
            $table->addColumn('manufacturer_company_name', function ($row) {
                return $row->manufacturer ? $row->manufacturer->company_name : '';
            });

            $table->addColumn('equipment_type_name', function ($row) {
                return $row->equipment_type ? $row->equipment_type->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'manufacturer', 'equipment_type']);

            return $table->make(true);
        }

        $contact_companies = ContactCompany::get();
        $equipment_types   = EquipmentType::get();

        return view('admin.equipment.index', compact('contact_companies', 'equipment_types'));
    }

    public function create()
    {
        abort_if(Gate::denies('equipment_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $manufacturers = ContactCompany::all()->pluck('company_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $equipment_types = EquipmentType::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.equipment.create', compact('manufacturers', 'equipment_types'));
    }

    public function store(StoreEquipmentRequest $request)
    {
        $equipment = Equipment::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $equipment->id]);
        }

        return redirect()->route('admin.equipment.index');
    }

    public function edit(Equipment $equipment)
    {
        abort_if(Gate::denies('equipment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $manufacturers = ContactCompany::all()->pluck('company_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $equipment_types = EquipmentType::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $equipment->load('manufacturer', 'equipment_type');

        return view('admin.equipment.edit', compact('manufacturers', 'equipment_types', 'equipment'));
    }

    public function update(UpdateEquipmentRequest $request, Equipment $equipment)
    {
        $equipment->update($request->all());

        return redirect()->route('admin.equipment.index');
    }

    public function show(Equipment $equipment)
    {
        abort_if(Gate::denies('equipment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $equipment->load('manufacturer', 'equipment_type', 'equipmentEquipmentAudits');

        return view('admin.equipment.show', compact('equipment'));
    }

    public function destroy(Equipment $equipment)
    {
        abort_if(Gate::denies('equipment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $equipment->delete();

        return back();
    }

    public function massDestroy(MassDestroyEquipmentRequest $request)
    {
        Equipment::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('equipment_create') && Gate::denies('equipment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Equipment();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
