<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSupplierAuditRequest;
use App\Http\Requests\UpdateSupplierAuditRequest;
use App\Http\Resources\Admin\SupplierAuditResource;
use App\Models\SupplierAudit;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SupplierAuditApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('supplier_audit_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SupplierAuditResource(SupplierAudit::with(['supplier', 'inspector', 'export_countries', 'client_1_country', 'client_1_company', 'client_1_product_types', 'client_2_country', 'client_2_company', 'client_3_country', 'client_3_company', 'primary_materials'])->get());
    }

    public function store(StoreSupplierAuditRequest $request)
    {
        $supplierAudit = SupplierAudit::create($request->all());
        $supplierAudit->export_countries()->sync($request->input('export_countries', []));
        $supplierAudit->client_1_product_types()->sync($request->input('client_1_product_types', []));

        return (new SupplierAuditResource($supplierAudit))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(SupplierAudit $supplierAudit)
    {
        abort_if(Gate::denies('supplier_audit_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SupplierAuditResource($supplierAudit->load(['supplier', 'inspector', 'export_countries', 'client_1_country', 'client_1_company', 'client_1_product_types', 'client_2_country', 'client_2_company', 'client_3_country', 'client_3_company', 'primary_materials']));
    }

    public function update(UpdateSupplierAuditRequest $request, SupplierAudit $supplierAudit)
    {
        $supplierAudit->update($request->all());
        $supplierAudit->export_countries()->sync($request->input('export_countries', []));
        $supplierAudit->client_1_product_types()->sync($request->input('client_1_product_types', []));

        return (new SupplierAuditResource($supplierAudit))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(SupplierAudit $supplierAudit)
    {
        abort_if(Gate::denies('supplier_audit_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $supplierAudit->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
