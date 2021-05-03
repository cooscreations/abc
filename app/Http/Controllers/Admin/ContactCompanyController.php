<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyContactCompanyRequest;
use App\Http\Requests\StoreContactCompanyRequest;
use App\Http\Requests\UpdateContactCompanyRequest;
use App\Models\Address;
use App\Models\CompanyOwnershipType;
use App\Models\CompanyType;
use App\Models\ContactCompany;
use App\Models\ContactContact;
use App\Models\Country;
use App\Models\Language;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ContactCompanyController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('contact_company_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ContactCompany::with(['parent_company', 'primary_company_type', 'reg_country', 'owner_contact', 'ownership_type', 'primary_language', 'addresses'])->select(sprintf('%s.*', (new ContactCompany())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'contact_company_show';
                $editGate = 'contact_company_edit';
                $deleteGate = 'contact_company_delete';
                $crudRoutePart = 'contact-companies';

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
            $table->editColumn('company_short_code', function ($row) {
                return $row->company_short_code ? $row->company_short_code : '';
            });
            $table->editColumn('company_name', function ($row) {
                return $row->company_name ? $row->company_name : '';
            });
            $table->editColumn('company_website', function ($row) {
                return $row->company_website ? $row->company_website : '';
            });
            $table->editColumn('company_email', function ($row) {
                return $row->company_email ? $row->company_email : '';
            });
            $table->addColumn('primary_company_type_name', function ($row) {
                return $row->primary_company_type ? $row->primary_company_type->name : '';
            });

            $table->editColumn('primary_company_type.icon', function ($row) {
                return $row->primary_company_type ? (is_string($row->primary_company_type) ? $row->primary_company_type : $row->primary_company_type->icon) : '';
            });
            $table->addColumn('reg_country_alpha_2', function ($row) {
                return $row->reg_country ? $row->reg_country->alpha_2 : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'primary_company_type', 'reg_country']);

            return $table->make(true);
        }

        $contact_companies       = ContactCompany::get();
        $company_types           = CompanyType::get();
        $countries               = Country::get();
        $contact_contacts        = ContactContact::get();
        $company_ownership_types = CompanyOwnershipType::get();
        $languages               = Language::get();
        $addresses               = Address::get();

        return view('admin.contactCompanies.index', compact('contact_companies', 'company_types', 'countries', 'contact_contacts', 'company_ownership_types', 'languages', 'addresses'));
    }

    public function create()
    {
        abort_if(Gate::denies('contact_company_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $parent_companies = ContactCompany::all()->pluck('company_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $primary_company_types = CompanyType::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $reg_countries = Country::all()->pluck('alpha_2', 'id')->prepend(trans('global.pleaseSelect'), '');

        $owner_contacts = ContactContact::all()->pluck('contact_first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $ownership_types = CompanyOwnershipType::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $primary_languages = Language::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $addresses = Address::all()->pluck('name', 'id');

        return view('admin.contactCompanies.create', compact('parent_companies', 'primary_company_types', 'reg_countries', 'owner_contacts', 'ownership_types', 'primary_languages', 'addresses'));
    }

    public function store(StoreContactCompanyRequest $request)
    {
        $contactCompany = ContactCompany::create($request->all());
        $contactCompany->addresses()->sync($request->input('addresses', []));

        return redirect()->route('admin.contact-companies.index');
    }

    public function edit(ContactCompany $contactCompany)
    {
        abort_if(Gate::denies('contact_company_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $parent_companies = ContactCompany::all()->pluck('company_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $primary_company_types = CompanyType::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $reg_countries = Country::all()->pluck('alpha_2', 'id')->prepend(trans('global.pleaseSelect'), '');

        $owner_contacts = ContactContact::all()->pluck('contact_first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $ownership_types = CompanyOwnershipType::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $primary_languages = Language::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $addresses = Address::all()->pluck('name', 'id');

        $contactCompany->load('parent_company', 'primary_company_type', 'reg_country', 'owner_contact', 'ownership_type', 'primary_language', 'addresses');

        return view('admin.contactCompanies.edit', compact('parent_companies', 'primary_company_types', 'reg_countries', 'owner_contacts', 'ownership_types', 'primary_languages', 'addresses', 'contactCompany'));
    }

    public function update(UpdateContactCompanyRequest $request, ContactCompany $contactCompany)
    {
        $contactCompany->update($request->all());
        $contactCompany->addresses()->sync($request->input('addresses', []));

        return redirect()->route('admin.contact-companies.index');
    }

    public function show(ContactCompany $contactCompany)
    {
        abort_if(Gate::denies('contact_company_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contactCompany->load('parent_company', 'primary_company_type', 'reg_country', 'owner_contact', 'ownership_type', 'primary_language', 'addresses', 'companyProductNicknames', 'customerOrders', 'supplierOrders', 'companyAddresses', 'shippingCompanyShippingContainers', 'companyCompanyRoles', 'manufacturerEquipment', 'companyEquipmentAudits', 'primarySupplierFabricGroups', 'companyBankAccounts', 'customerFabricNicknames', 'supplierInspections', 'customerInspections', 'shippingAgentOrders', 'supplierSupplierAudits', 'client1CompanySupplierAudits', 'client2CompanySupplierAudits', 'client3CompanySupplierAudits', 'parentCompanyContactCompanies', 'relatedCompaniesDocuments', 'primarySuppliersProducts', 'primarySupplierComponentParts');

        return view('admin.contactCompanies.show', compact('contactCompany'));
    }

    public function destroy(ContactCompany $contactCompany)
    {
        abort_if(Gate::denies('contact_company_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contactCompany->delete();

        return back();
    }

    public function massDestroy(MassDestroyContactCompanyRequest $request)
    {
        ContactCompany::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
