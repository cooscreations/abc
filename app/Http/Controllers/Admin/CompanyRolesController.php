<?php

namespace App\Http\Controllers\Admin;

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
use Yajra\DataTables\Facades\DataTables;

class CompanyRolesController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('company_role_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = CompanyRole::with(['company', 'role', 'contact'])->select(sprintf('%s.*', (new CompanyRole())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'company_role_show';
                $editGate = 'company_role_edit';
                $deleteGate = 'company_role_delete';
                $crudRoutePart = 'company-roles';

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
            $table->addColumn('company_company_name', function ($row) {
                return $row->company ? $row->company->company_name : '';
            });

            $table->addColumn('role_title', function ($row) {
                return $row->role ? $row->role->title : '';
            });

            $table->addColumn('contact_contact_first_name', function ($row) {
                return $row->contact ? $row->contact->contact_first_name : '';
            });

            $table->editColumn('contact.contact_last_name', function ($row) {
                return $row->contact ? (is_string($row->contact) ? $row->contact : $row->contact->contact_last_name) : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'company', 'role', 'contact']);

            return $table->make(true);
        }

        return view('admin.companyRoles.index');
    }

    public function create()
    {
        abort_if(Gate::denies('company_role_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $companies = ContactCompany::all()->pluck('company_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $roles = Role::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $contacts = ContactContact::all()->pluck('contact_first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.companyRoles.create', compact('companies', 'roles', 'contacts'));
    }

    public function store(StoreCompanyRoleRequest $request)
    {
        $companyRole = CompanyRole::create($request->all());

        return redirect()->route('admin.company-roles.index');
    }

    public function edit(CompanyRole $companyRole)
    {
        abort_if(Gate::denies('company_role_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $companies = ContactCompany::all()->pluck('company_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $roles = Role::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $contacts = ContactContact::all()->pluck('contact_first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $companyRole->load('company', 'role', 'contact');

        return view('admin.companyRoles.edit', compact('companies', 'roles', 'contacts', 'companyRole'));
    }

    public function update(UpdateCompanyRoleRequest $request, CompanyRole $companyRole)
    {
        $companyRole->update($request->all());

        return redirect()->route('admin.company-roles.index');
    }

    public function show(CompanyRole $companyRole)
    {
        abort_if(Gate::denies('company_role_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $companyRole->load('company', 'role', 'contact');

        return view('admin.companyRoles.show', compact('companyRole'));
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
