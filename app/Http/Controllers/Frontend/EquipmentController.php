<?php

namespace App\Http\Controllers\Frontend;

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

class EquipmentController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('equipment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $equipment = Equipment::with(['manufacturer', 'equipment_type'])->get();

        $contact_companies = ContactCompany::get();

        $equipment_types = EquipmentType::get();

        return view('frontend.equipment.index', compact('equipment', 'contact_companies', 'equipment_types'));
    }

    public function create()
    {
        abort_if(Gate::denies('equipment_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $manufacturers = ContactCompany::all()->pluck('company_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $equipment_types = EquipmentType::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.equipment.create', compact('manufacturers', 'equipment_types'));
    }

    public function store(StoreEquipmentRequest $request)
    {
        $equipment = Equipment::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $equipment->id]);
        }

        return redirect()->route('frontend.equipment.index');
    }

    public function edit(Equipment $equipment)
    {
        abort_if(Gate::denies('equipment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $manufacturers = ContactCompany::all()->pluck('company_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $equipment_types = EquipmentType::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $equipment->load('manufacturer', 'equipment_type');

        return view('frontend.equipment.edit', compact('manufacturers', 'equipment_types', 'equipment'));
    }

    public function update(UpdateEquipmentRequest $request, Equipment $equipment)
    {
        $equipment->update($request->all());

        return redirect()->route('frontend.equipment.index');
    }

    public function show(Equipment $equipment)
    {
        abort_if(Gate::denies('equipment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $equipment->load('manufacturer', 'equipment_type', 'equipmentEquipmentAudits');

        return view('frontend.equipment.show', compact('equipment'));
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
