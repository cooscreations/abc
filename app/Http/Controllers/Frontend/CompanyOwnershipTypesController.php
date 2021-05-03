<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyCompanyOwnershipTypeRequest;
use App\Http\Requests\StoreCompanyOwnershipTypeRequest;
use App\Http\Requests\UpdateCompanyOwnershipTypeRequest;
use App\Models\CompanyOwnershipType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CompanyOwnershipTypesController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('company_ownership_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $companyOwnershipTypes = CompanyOwnershipType::all();

        return view('frontend.companyOwnershipTypes.index', compact('companyOwnershipTypes'));
    }

    public function create()
    {
        abort_if(Gate::denies('company_ownership_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.companyOwnershipTypes.create');
    }

    public function store(StoreCompanyOwnershipTypeRequest $request)
    {
        $companyOwnershipType = CompanyOwnershipType::create($request->all());

        return redirect()->route('frontend.company-ownership-types.index');
    }

    public function edit(CompanyOwnershipType $companyOwnershipType)
    {
        abort_if(Gate::denies('company_ownership_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.companyOwnershipTypes.edit', compact('companyOwnershipType'));
    }

    public function update(UpdateCompanyOwnershipTypeRequest $request, CompanyOwnershipType $companyOwnershipType)
    {
        $companyOwnershipType->update($request->all());

        return redirect()->route('frontend.company-ownership-types.index');
    }

    public function show(CompanyOwnershipType $companyOwnershipType)
    {
        abort_if(Gate::denies('company_ownership_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $companyOwnershipType->load('ownershipTypeContactCompanies');

        return view('frontend.companyOwnershipTypes.show', compact('companyOwnershipType'));
    }

    public function destroy(CompanyOwnershipType $companyOwnershipType)
    {
        abort_if(Gate::denies('company_ownership_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $companyOwnershipType->delete();

        return back();
    }

    public function massDestroy(MassDestroyCompanyOwnershipTypeRequest $request)
    {
        CompanyOwnershipType::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
