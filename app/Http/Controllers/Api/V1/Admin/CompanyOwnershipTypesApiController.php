<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCompanyOwnershipTypeRequest;
use App\Http\Requests\UpdateCompanyOwnershipTypeRequest;
use App\Http\Resources\Admin\CompanyOwnershipTypeResource;
use App\Models\CompanyOwnershipType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CompanyOwnershipTypesApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('company_ownership_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CompanyOwnershipTypeResource(CompanyOwnershipType::all());
    }

    public function store(StoreCompanyOwnershipTypeRequest $request)
    {
        $companyOwnershipType = CompanyOwnershipType::create($request->all());

        return (new CompanyOwnershipTypeResource($companyOwnershipType))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(CompanyOwnershipType $companyOwnershipType)
    {
        abort_if(Gate::denies('company_ownership_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CompanyOwnershipTypeResource($companyOwnershipType);
    }

    public function update(UpdateCompanyOwnershipTypeRequest $request, CompanyOwnershipType $companyOwnershipType)
    {
        $companyOwnershipType->update($request->all());

        return (new CompanyOwnershipTypeResource($companyOwnershipType))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(CompanyOwnershipType $companyOwnershipType)
    {
        abort_if(Gate::denies('company_ownership_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $companyOwnershipType->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
