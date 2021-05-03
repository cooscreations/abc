<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEquipmentAuditRequest;
use App\Http\Requests\UpdateEquipmentAuditRequest;
use App\Http\Resources\Admin\EquipmentAuditResource;
use App\Models\EquipmentAudit;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EquipmentAuditApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('equipment_audit_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EquipmentAuditResource(EquipmentAudit::with(['equipment', 'company', 'location'])->get());
    }

    public function store(StoreEquipmentAuditRequest $request)
    {
        $equipmentAudit = EquipmentAudit::create($request->all());

        return (new EquipmentAuditResource($equipmentAudit))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(EquipmentAudit $equipmentAudit)
    {
        abort_if(Gate::denies('equipment_audit_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EquipmentAuditResource($equipmentAudit->load(['equipment', 'company', 'location']));
    }

    public function update(UpdateEquipmentAuditRequest $request, EquipmentAudit $equipmentAudit)
    {
        $equipmentAudit->update($request->all());

        return (new EquipmentAuditResource($equipmentAudit))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(EquipmentAudit $equipmentAudit)
    {
        abort_if(Gate::denies('equipment_audit_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $equipmentAudit->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
