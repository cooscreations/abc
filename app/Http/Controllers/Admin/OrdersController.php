<?php

namespace App\Http\Controllers\Admin;

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
use Yajra\DataTables\Facades\DataTables;

class OrdersController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Order::with(['sales_person', 'order_follower', 'order_status', 'order_type', 'customer', 'order_placed_by', 'shipping_agent', 'ship_from_port', 'ship_to_port', 'ship_to_address', 'bill_to_address', 'quality_control_staffs', 'supplier', 'packaging_type', 'afa_bank_account_to_pay'])->select(sprintf('%s.*', (new Order())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'order_show';
                $editGate = 'order_edit';
                $deleteGate = 'order_delete';
                $crudRoutePart = 'orders';

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
            $table->editColumn('afa_order_num', function ($row) {
                return $row->afa_order_num ? $row->afa_order_num : '';
            });
            $table->addColumn('order_follower_full_name', function ($row) {
                return $row->order_follower ? $row->order_follower->full_name : '';
            });

            $table->editColumn('order_follower.full_name', function ($row) {
                return $row->order_follower ? (is_string($row->order_follower) ? $row->order_follower : $row->order_follower->full_name) : '';
            });
            $table->addColumn('order_status_name', function ($row) {
                return $row->order_status ? $row->order_status->name : '';
            });

            $table->addColumn('order_type_name', function ($row) {
                return $row->order_type ? $row->order_type->name : '';
            });

            $table->editColumn('customer_order_number', function ($row) {
                return $row->customer_order_number ? $row->customer_order_number : '';
            });
            $table->addColumn('customer_company_name', function ($row) {
                return $row->customer ? $row->customer->company_name : '';
            });

            $table->editColumn('customer.company_name', function ($row) {
                return $row->customer ? (is_string($row->customer) ? $row->customer : $row->customer->company_name) : '';
            });
            $table->editColumn('pi_value_placed_usd', function ($row) {
                return $row->pi_value_placed_usd ? $row->pi_value_placed_usd : '';
            });
            $table->editColumn('customer_deposit_rate', function ($row) {
                return $row->customer_deposit_rate ? $row->customer_deposit_rate : '';
            });
            $table->editColumn('customer_balance_usd', function ($row) {
                return $row->customer_balance_usd ? $row->customer_balance_usd : '';
            });
            $table->addColumn('supplier_company_name', function ($row) {
                return $row->supplier ? $row->supplier->company_name : '';
            });

            $table->editColumn('leadtime_days', function ($row) {
                return $row->leadtime_days ? $row->leadtime_days : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'order_follower', 'order_status', 'order_type', 'customer', 'supplier']);

            return $table->make(true);
        }

        $contact_contacts  = ContactContact::get();
        $afa_staffs        = AfaStaff::get();
        $order_statuses    = OrderStatus::get();
        $ordertypes        = Ordertype::get();
        $contact_companies = ContactCompany::get();
        $addresses         = Address::get();
        $packaging_types   = PackagingType::get();
        $bank_accounts     = BankAccount::get();

        return view('admin.orders.index', compact('contact_contacts', 'afa_staffs', 'order_statuses', 'ordertypes', 'contact_companies', 'addresses', 'packaging_types', 'bank_accounts'));
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

        return view('admin.orders.create', compact('sales_people', 'order_followers', 'order_statuses', 'order_types', 'customers', 'order_placed_bies', 'shipping_agents', 'ship_from_ports', 'ship_to_ports', 'ship_to_addresses', 'bill_to_addresses', 'quality_control_staffs', 'suppliers', 'packaging_types', 'afa_bank_account_to_pays'));
    }

    public function store(StoreOrderRequest $request)
    {
        $order = Order::create($request->all());
        $order->quality_control_staffs()->sync($request->input('quality_control_staffs', []));

        return redirect()->route('admin.orders.index');
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

        return view('admin.orders.edit', compact('sales_people', 'order_followers', 'order_statuses', 'order_types', 'customers', 'order_placed_bies', 'shipping_agents', 'ship_from_ports', 'ship_to_ports', 'ship_to_addresses', 'bill_to_addresses', 'quality_control_staffs', 'suppliers', 'packaging_types', 'afa_bank_account_to_pays', 'order'));
    }

    public function update(UpdateOrderRequest $request, Order $order)
    {
        $order->update($request->all());
        $order->quality_control_staffs()->sync($request->input('quality_control_staffs', []));

        return redirect()->route('admin.orders.index');
    }

    public function show(Order $order)
    {
        abort_if(Gate::denies('order_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $order->load('sales_person', 'order_follower', 'order_status', 'order_type', 'customer', 'order_placed_by', 'shipping_agent', 'ship_from_port', 'ship_to_port', 'ship_to_address', 'bill_to_address', 'quality_control_staffs', 'supplier', 'packaging_type', 'afa_bank_account_to_pay', 'orderOrderItems', 'orderShippingContainers', 'orderOrderRoles', 'orderInspections', 'orderIncomes', 'relatedOrdersDocuments');

        return view('admin.orders.show', compact('order'));
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
