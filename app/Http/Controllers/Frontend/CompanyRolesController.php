<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyCompanyRoleRequest;
use App\Http\Requests\StoreCompanyRoleRequest;
use App\Http\Requests\UpdateCompanyRoleRequest;
use App\Models\CompanyRole;
use App\Models\ContactCompany;
use App\Models\ContactContact;
use App\Models\Role;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CompanyRolesController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('company_role_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $companyRoles = CompanyRole::with(['company', 'role', 'contact'])->get();

        return view('frontend.companyRoles.index', compact('companyRoles'));
    }

    public function create()
    {
        abort_if(Gate::denies('company_role_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $companies = ContactCompany::all()->pluck('company_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $roles = Role::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $contacts = ContactContact::all()->pluck('contact_first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.companyRoles.create', compact('companies', 'roles', 'contacts'));
    }

    public function store(StoreCompanyRoleRequest $request)
    {
        $companyRole = CompanyRole::create($request->all());

        return redirect()->route('frontend.company-roles.index');
    }

    public function edit(CompanyRole $companyRole)
    {
        abort_if(Gate::denies('company_role_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $companies = ContactCompany::all()->pluck('company_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $roles = Role::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $contacts = ContactContact::all()->pluck('contact_first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $companyRole->load('company', 'role', 'contact');

        return view('frontend.companyRoles.edit', compact('companies', 'roles', 'contacts', 'companyRole'));
    }

    public function update(UpdateCompanyRoleRequest $request, CompanyRole $companyRole)
    {
        $companyRole->update($request->all());

        return redirect()->route('frontend.company-roles.index');
    }

    public function show(CompanyRole $companyRole)
    {
        abort_if(Gate::denies('company_role_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $companyRole->load('company', 'role', 'contact');

        return view('frontend.companyRoles.show', compact('companyRole'));
    }

    public function destroy(CompanyRole $companyRole)
    {
        abort_if(Gate::denies('company_role_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $companyRole->delete();

        return back();
    }

    public function massDestroy(MassDestroyCompanyRoleRequest $request)
    {
        CompanyRole::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
