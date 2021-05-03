<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyOrderRequest;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Address;
use App\Models\AfaStaff;
use App\Models\BankAccount;
use App\Models\ContactCompany;
use App\Models\ContactContact;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\Ordertype;
use App\Models\PackagingType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OrdersController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $orders = Order::with(['sales_person', 'order_follower', 'order_status', 'order_type', 'customer', 'order_placed_by', 'shipping_agent', 'ship_from_port', 'ship_to_port', 'ship_to_address', 'bill_to_address', 'quality_control_staffs', 'supplier', 'packaging_type', 'afa_bank_account_to_pay'])->get();

        $contact_contacts = ContactContact::get();

        $afa_staffs = AfaStaff::get();

        $order_statuses = OrderStatus::get();

        $ordertypes = Ordertype::get();

        $contact_companies = ContactCompany::get();

        $addresses = Address::get();

        $packaging_types = PackagingType::get();

        $bank_accounts = BankAccount::get();

        return view('frontend.orders.index', compact('orders', 'contact_contacts', 'afa_staffs', 'order_statuses', 'ordertypes', 'contact_companies', 'addresses', 'packaging_types', 'bank_accounts'));
    }

    public function create()
    {
        abort_if(Gate::denies('order_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sales_people = ContactContact::all()->pluck('contact_first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $order_followers = AfaStaff::all()->pluck('full_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $order_statuses = OrderStatus::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $order_types = Ordertype::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $customers = ContactCompany::all()->pluck('company_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $order_placed_bies = ContactContact::all()->pluck('contact_first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $shipping_agents = ContactCompany::all()->pluck('company_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $ship_from_ports = Address::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $ship_to_ports = Address::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $ship_to_addresses = Address::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $bill_to_addresses = Address::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $quality_control_staffs = AfaStaff::all()->pluck('full_name', 'id');

        $suppliers = ContactCompany::all()->pluck('company_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $packaging_types = PackagingType::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $afa_bank_account_to_pays = BankAccount::all()->pluck('bank_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.orders.create', compact('sales_people', 'order_followers', 'order_statuses', 'order_types', 'customers', 'order_placed_bies', 'shipping_agents', 'ship_from_ports', 'ship_to_ports', 'ship_to_addresses', 'bill_to_addresses', 'quality_control_staffs', 'suppliers', 'packaging_types', 'afa_bank_account_to_pays'));
    }

    public function store(StoreOrderRequest $request)
    {
        $order = Order::create($request->all());
        $order->quality_control_staffs()->sync($request->input('quality_control_staffs', []));

        return redirect()->route('frontend.orders.index');
    }

    public function edit(Order $order)
    {
        abort_if(Gate::denies('order_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sales_people = ContactContact::all()->pluck('contact_first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $order_followers = AfaStaff::all()->pluck('full_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $order_statuses = OrderStatus::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $order_types = Ordertype::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $customers = ContactCompany::all()->pluck('company_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $order_placed_bies = ContactContact::all()->pluck('contact_first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $shipping_agents = ContactCompany::all()->pluck('company_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $ship_from_ports = Address::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $ship_to_ports = Address::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $ship_to_addresses = Address::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $bill_to_addresses = Address::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $quality_control_staffs = AfaStaff::all()->pluck('full_name', 'id');

        $suppliers = ContactCompany::all()->pluck('company_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $packaging_types = PackagingType::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $afa_bank_account_to_pays = BankAccount::all()->pluck('bank_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $order->load('sales_person', 'order_follower', 'order_status', 'order_type', 'customer', 'order_placed_by', 'shipping_agent', 'ship_from_port', 'ship_to_port', 'ship_to_address', 'bill_to_address', 'quality_control_staffs', 'supplier', 'packaging_type', 'afa_bank_account_to_pay');

        return view('frontend.orders.edit', compact('sales_people', 'order_followers', 'order_statuses', 'order_types', 'customers', 'order_placed_bies', 'shipping_agents', 'ship_from_ports', 'ship_to_ports', 'ship_to_addresses', 'bill_to_addresses', 'quality_control_staffs', 'suppliers', 'packaging_types', 'afa_bank_account_to_pays', 'order'));
    }

    public function update(UpdateOrderRequest $request, Order $order)
    {
        $order->update($request->all());
        $order->quality_control_staffs()->sync($request->input('quality_control_staffs', []));

        return redirect()->route('frontend.orders.index');
    }

    public function show(Order $order)
    {
        abort_if(Gate::denies('order_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $order->load('sales_person', 'order_follower', 'order_status', 'order_type', 'customer', 'order_placed_by', 'shipping_agent', 'ship_from_port', 'ship_to_port', 'ship_to_address', 'bill_to_address', 'quality_control_staffs', 'supplier', 'packaging_type', 'afa_bank_account_to_pay', 'orderOrderItems', 'orderShippingContainers', 'orderOrderRoles', 'orderInspections', 'orderIncomes', 'relatedOrdersDocuments');

        return view('frontend.orders.show', compact('order'));
    }

    public function destroy(Order $order)
    {
        abort_if(Gate::denies('order_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $order->delete();

        return back();
    }

    public function massDestroy(MassDestroyOrderRequest $request)
    {
        Order::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
