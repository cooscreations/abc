<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyAddressRequest;
use App\Http\Requests\StoreAddressRequest;
use App\Http\Requests\UpdateAddressRequest;
use App\Models\Address;
use App\Models\ContactCompany;
use App\Models\Country;
use App\Models\Province;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AddressesController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('address_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Address::with(['company', 'province', 'country', 'nearest_shipping_port'])->select(sprintf('%s.*', (new Address())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'address_show';
                $editGate = 'address_edit';
                $deleteGate = 'address_delete';
                $crudRoutePart = 'addresses';

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
            $table->addColumn('company_company_name', function ($row) {
                return $row->company ? $row->company->company_name : '';
            });

            $table->editColumn('city', function ($row) {
                return $row->city ? $row->city : '';
            });
            $table->addColumn('province_name', function ($row) {
                return $row->province ? $row->province->name : '';
            });

            $table->editColumn('province.local_name', function ($row) {
                return $row->province ? (is_string($row->province) ? $row->province : $row->province->local_name) : '';
            });
            $table->addColumn('country_name', function ($row) {
                return $row->country ? $row->country->name : '';
            });

            $table->editColumn('country.alpha_2', function ($row) {
                return $row->country ? (is_string($row->country) ? $row->country : $row->country->alpha_2) : '';
            });
            $table->editColumn('is_billing_address', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->is_billing_address ? 'checked' : null) . '>';
            });
            $table->editColumn('is_shipping_address', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->is_shipping_address ? 'checked' : null) . '>';
            });

            $table->rawColumns(['actions', 'placeholder', 'company', 'province', 'country', 'is_billing_address', 'is_shipping_address']);

            return $table->make(true);
        }

        $contact_companies = ContactCompany::get();
        $provinces         = Province::get();
        $countries         = Country::get();
        $addresses         = Address::get();

        return view('admin.addresses.index', compact('contact_companies', 'provinces', 'countries', 'addresses'));
    }

    public function create()
    {
        abort_if(Gate::denies('address_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $companies = ContactCompany::all()->pluck('company_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $provinces = Province::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $countries = Country::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $nearest_shipping_ports = Address::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.addresses.create', compact('companies', 'provinces', 'countries', 'nearest_shipping_ports'));
    }

    public function store(StoreAddressRequest $request)
    {
        $address = Address::create($request->all());

        return redirect()->route('admin.addresses.index');
    }

    public function edit(Address $address)
    {
        abort_if(Gate::denies('address_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $companies = ContactCompany::all()->pluck('company_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $provinces = Province::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $countries = Country::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $nearest_shipping_ports = Address::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $address->load('company', 'province', 'country', 'nearest_shipping_port');

        return view('admin.addresses.edit', compact('companies', 'provinces', 'countries', 'nearest_shipping_ports', 'address'));
    }

    public function update(UpdateAddressRequest $request, Address $address)
    {
        $address->update($request->all());

        return redirect()->route('admin.addresses.index');
    }

    public function show(Address $address)
    {
        abort_if(Gate::denies('address_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $address->load('company', 'province', 'country', 'nearest_shipping_port', 'billToAddressOrders', 'shipToAddressOrders', 'locationEquipmentAudits', 'addressBankAccounts', 'primaryAddressContactContacts', 'nearestShippingPortAddresses', 'shipFromPortOrders', 'shipToPortOrders', 'addressesContactCompanies');

        return view('admin.addresses.show', compact('address'));
    }

    public function destroy(Address $address)
    {
        abort_if(Gate::denies('address_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $address->delete();

        return back();
    }

    public function massDestroy(MassDestroyAddressRequest $request)
    {
        Address::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
