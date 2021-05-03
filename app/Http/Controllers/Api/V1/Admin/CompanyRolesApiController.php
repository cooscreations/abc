<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCompanyRoleRequest;
use App\Http\Requests\UpdateCompanyRoleRequest;
use App\Http\Resources\Admin\CompanyRoleResource;
use App\Models\CompanyRole;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CompanyRolesApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('company_role_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CompanyRoleResource(CompanyRole::with(['company', 'role', 'contact'])->get());
    }

    public function store(StoreCompanyRoleRequest $request)
    {
        $companyRole = CompanyRole::create($request->all());

        return (new CompanyRoleResource($companyRole))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(CompanyRole $companyRole)
    {
        abort_if(Gate::denies('company_role_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CompanyRoleResource($companyRole->load(['company', 'role', 'contact']));
    }

    public function update(UpdateCompanyRoleRequest $request, CompanyRole $companyRole)
    {
        $companyRole->update($request->all());

        return (new CompanyRoleResource($companyRole))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(CompanyRole $companyRole)
    {
        abort_if(Gate::denies('company_role_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $companyRole->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
