<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyEquipmentAuditRequest;
use App\Http\Requests\StoreEquipmentAuditRequest;
use App\Http\Requests\UpdateEquipmentAuditRequest;
use App\Models\Address;
use App\Models\ContactCompany;
use App\Models\Equipment;
use App\Models\EquipmentAudit;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EquipmentAuditController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('equipment_audit_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $equipmentAudits = EquipmentAudit::with(['equipment', 'company', 'location'])->get();

        $equipment = Equipment::get();

        $contact_companies = ContactCompany::get();

        $addresses = Address::get();

        return view('frontend.equipmentAudits.index', compact('equipmentAudits', 'equipment', 'contact_companies', 'addresses'));
    }

    public function create()
    {
        abort_if(Gate::denies('equipment_audit_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $equipment = Equipment::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $companies = ContactCompany::all()->pluck('company_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $locations = Address::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.equipmentAudits.create', compact('equipment', 'companies', 'locations'));
    }

    public function store(StoreEquipmentAuditRequest $request)
    {
        $equipmentAudit = EquipmentAudit::create($request->all());

        return redirect()->route('frontend.equipment-audits.index');
    }

    public function edit(EquipmentAudit $equipmentAudit)
    {
        abort_if(Gate::denies('equipment_audit_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $equipment = Equipment::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $companies = ContactCompany::all()->pluck('company_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $locations = Address::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $equipmentAudit->load('equipment', 'company', 'location');

        return view('frontend.equipmentAudits.edit', compact('equipment', 'companies', 'locations', 'equipmentAudit'));
    }

    public function update(UpdateEquipmentAuditRequest $request, EquipmentAudit $equipmentAudit)
    {
        $equipmentAudit->update($request->all());

        return redirect()->route('frontend.equipment-audits.index');
    }

    public function show(EquipmentAudit $equipmentAudit)
    {
        abort_if(Gate::denies('equipment_audit_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $equipmentAudit->load('equipment', 'company', 'location');

        return view('frontend.equipmentAudits.show', compact('equipmentAudit'));
    }

    public function destroy(EquipmentAudit $equipmentAudit)
    {
        abort_if(Gate::denies('equipment_audit_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $equipmentAudit->delete();

        return back();
    }

    public function massDestroy(MassDestroyEquipmentAuditRequest $request)
    {
        EquipmentAudit::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
