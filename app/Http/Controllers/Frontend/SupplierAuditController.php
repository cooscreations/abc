<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroySupplierAuditRequest;
use App\Http\Requests\StoreSupplierAuditRequest;
use App\Http\Requests\UpdateSupplierAuditRequest;
use App\Models\ContactCompany;
use App\Models\Country;
use App\Models\ProductType;
use App\Models\RawMaterial;
use App\Models\SupplierAudit;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SupplierAuditController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('supplier_audit_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $supplierAudits = SupplierAudit::with(['supplier', 'inspector', 'export_countries', 'client_1_country', 'client_1_company', 'client_1_product_types', 'client_2_country', 'client_2_company', 'client_3_country', 'client_3_company', 'primary_materials'])->get();

        $contact_companies = ContactCompany::get();

        $users = User::get();

        $countries = Country::get();

        $product_types = ProductType::get();

        $raw_materials = RawMaterial::get();

        return view('frontend.supplierAudits.index', compact('supplierAudits', 'contact_companies', 'users', 'countries', 'product_types', 'raw_materials'));
    }

    public function create()
    {
        abort_if(Gate::denies('supplier_audit_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $suppliers = ContactCompany::all()->pluck('company_short_code', 'id')->prepend(trans('global.pleaseSelect'), '');

        $inspectors = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $export_countries = Country::all()->pluck('alpha_2', 'id');

        $client_1_countries = Country::all()->pluck('alpha_2', 'id')->prepend(trans('global.pleaseSelect'), '');

        $client_1_companies = ContactCompany::all()->pluck('company_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $client_1_product_types = ProductType::all()->pluck('name', 'id');

        $client_2_countries = Country::all()->pluck('alpha_2', 'id')->prepend(trans('global.pleaseSelect'), '');

        $client_2_companies = ContactCompany::all()->pluck('company_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $client_3_countries = Country::all()->pluck('short_code', 'id')->prepend(trans('global.pleaseSelect'), '');

        $client_3_companies = ContactCompany::all()->pluck('company_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $primary_materials = RawMaterial::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.supplierAudits.create', compact('suppliers', 'inspectors', 'export_countries', 'client_1_countries', 'client_1_companies', 'client_1_product_types', 'client_2_countries', 'client_2_companies', 'client_3_countries', 'client_3_companies', 'primary_materials'));
    }

    public function store(StoreSupplierAuditRequest $request)
    {
        $supplierAudit = SupplierAudit::create($request->all());
        $supplierAudit->export_countries()->sync($request->input('export_countries', []));
        $supplierAudit->client_1_product_types()->sync($request->input('client_1_product_types', []));

        return redirect()->route('frontend.supplier-audits.index');
    }

    public function edit(SupplierAudit $supplierAudit)
    {
        abort_if(Gate::denies('supplier_audit_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $suppliers = ContactCompany::all()->pluck('company_short_code', 'id')->prepend(trans('global.pleaseSelect'), '');

        $inspectors = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $export_countries = Country::all()->pluck('alpha_2', 'id');

        $client_1_countries = Country::all()->pluck('alpha_2', 'id')->prepend(trans('global.pleaseSelect'), '');

        $client_1_companies = ContactCompany::all()->pluck('company_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $client_1_product_types = ProductType::all()->pluck('name', 'id');

        $client_2_countries = Country::all()->pluck('alpha_2', 'id')->prepend(trans('global.pleaseSelect'), '');

        $client_2_companies = ContactCompany::all()->pluck('company_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $client_3_countries = Country::all()->pluck('short_code', 'id')->prepend(trans('global.pleaseSelect'), '');

        $client_3_companies = ContactCompany::all()->pluck('company_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $primary_materials = RawMaterial::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $supplierAudit->load('supplier', 'inspector', 'export_countries', 'client_1_country', 'client_1_company', 'client_1_product_types', 'client_2_country', 'client_2_company', 'client_3_country', 'client_3_company', 'primary_materials');

        return view('frontend.supplierAudits.edit', compact('suppliers', 'inspectors', 'export_countries', 'client_1_countries', 'client_1_companies', 'client_1_product_types', 'client_2_countries', 'client_2_companies', 'client_3_countries', 'client_3_companies', 'primary_materials', 'supplierAudit'));
    }

    public function update(UpdateSupplierAuditRequest $request, SupplierAudit $supplierAudit)
    {
        $supplierAudit->update($request->all());
        $supplierAudit->export_countries()->sync($request->input('export_countries', []));
        $supplierAudit->client_1_product_types()->sync($request->input('client_1_product_types', []));

        return redirect()->route('frontend.supplier-audits.index');
    }

    public function show(SupplierAudit $supplierAudit)
    {
        abort_if(Gate::denies('supplier_audit_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $supplierAudit->load('supplier', 'inspector', 'export_countries', 'client_1_country', 'client_1_company', 'client_1_product_types', 'client_2_country', 'client_2_company', 'client_3_country', 'client_3_company', 'primary_materials');

        return view('frontend.supplierAudits.show', compact('supplierAudit'));
    }

    public function destroy(SupplierAudit $supplierAudit)
    {
        abort_if(Gate::denies('supplier_audit_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $supplierAudit->delete();

        return back();
    }

    public function massDestroy(MassDestroySupplierAuditRequest $request)
    {
        SupplierAudit::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
