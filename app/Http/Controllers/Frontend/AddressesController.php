<?php

namespace App\Http\Controllers\Frontend;

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

class AddressesController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('address_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $addresses = Address::get();

        $contact_companies = ContactCompany::get();

        $provinces = Province::get();

        $countries = Country::get();

        return view('frontend.addresses.index', compact('addresses', 'contact_companies', 'provinces', 'countries'));
    }

    public function create()
    {
        abort_if(Gate::denies('address_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $companies = ContactCompany::all()->pluck('company_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $provinces = Province::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $countries = Country::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $nearest_shipping_ports = Address::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.addresses.create', compact('companies', 'provinces', 'countries', 'nearest_shipping_ports'));
    }

    public function store(StoreAddressRequest $request)
    {
        $address = Address::create($request->all());

        return redirect()->route('frontend.addresses.index');
    }

    public function edit(Address $address)
    {
        abort_if(Gate::denies('address_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $companies = ContactCompany::all()->pluck('company_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $provinces = Province::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $countries = Country::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $nearest_shipping_ports = Address::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $address->load('company', 'province', 'country', 'nearest_shipping_port');

        return view('frontend.addresses.edit', compact('companies', 'provinces', 'countries', 'nearest_shipping_ports', 'address'));
    }

    public function update(UpdateAddressRequest $request, Address $address)
    {
        $address->update($request->all());

        return redirect()->route('frontend.addresses.index');
    }

    public function show(Address $address)
    {
        abort_if(Gate::denies('address_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $address->load('company', 'province', 'country', 'nearest_shipping_port', 'billToAddressOrders', 'shipToAddressOrders', 'locationEquipmentAudits', 'addressBankAccounts', 'primaryAddressContactContacts', 'nearestShippingPortAddresses');

        return view('frontend.addresses.show', compact('address'));
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
