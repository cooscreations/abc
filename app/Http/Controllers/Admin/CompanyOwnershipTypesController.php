<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyCompanyOwnershipTypeRequest;
use App\Http\Requests\StoreCompanyOwnershipTypeRequest;
use App\Http\Requests\UpdateCompanyOwnershipTypeRequest;
use App\Models\CompanyOwnershipType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class CompanyOwnershipTypesController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('company_ownership_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = CompanyOwnershipType::query()->select(sprintf('%s.*', (new CompanyOwnershipType())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'company_ownership_type_show';
                $editGate = 'company_ownership_type_edit';
                $deleteGate = 'company_ownership_type_delete';
                $crudRoutePart = 'company-ownership-types';

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
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.companyOwnershipTypes.index');
    }

    public function create()
    {
        abort_if(Gate::denies('company_ownership_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.companyOwnershipTypes.create');
    }

    public function store(StoreCompanyOwnershipTypeRequest $request)
    {
        $companyOwnershipType = CompanyOwnershipType::create($request->all());

        return redirect()->route('admin.company-ownership-types.index');
    }

    public function edit(CompanyOwnershipType $companyOwnershipType)
    {
        abort_if(Gate::denies('company_ownership_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.companyOwnershipTypes.edit', compact('companyOwnershipType'));
    }

    public function update(UpdateCompanyOwnershipTypeRequest $request, CompanyOwnershipType $companyOwnershipType)
    {
        $companyOwnershipType->update($request->all());

        return redirect()->route('admin.company-ownership-types.index');
    }

    public function show(CompanyOwnershipType $companyOwnershipType)
    {
        abort_if(Gate::denies('company_ownership_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $companyOwnershipType->load('ownershipTypeContactCompanies');

        return view('admin.companyOwnershipTypes.show', compact('companyOwnershipType'));
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
