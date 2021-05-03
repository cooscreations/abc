<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyOrderRoleRequest;
use App\Http\Requests\StoreOrderRoleRequest;
use App\Http\Requests\UpdateOrderRoleRequest;
use App\Models\ContactContact;
use App\Models\Order;
use App\Models\OrderRole;
use App\Models\Role;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class OrderRolesController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('order_role_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = OrderRole::with(['order', 'role', 'contact', 'user'])->select(sprintf('%s.*', (new OrderRole())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'order_role_show';
                $editGate = 'order_role_edit';
                $deleteGate = 'order_role_delete';
                $crudRoutePart = 'order-roles';

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
            $table->addColumn('role_title', function ($row) {
                return $row->role ? $row->role->title : '';
            });

            $table->addColumn('contact_contact_first_name', function ($row) {
                return $row->contact ? $row->contact->contact_first_name : '';
            });

            $table->editColumn('contact.contact_last_name', function ($row) {
                return $row->contact ? (is_string($row->contact) ? $row->contact : $row->contact->contact_last_name) : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'role', 'contact']);

            return $table->make(true);
        }

        return view('admin.orderRoles.index');
    }

    public function create()
    {
        abort_if(Gate::denies('order_role_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $orders = Order::all()->pluck('afa_order_num', 'id')->prepend(trans('global.pleaseSelect'), '');

        $roles = Role::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $contacts = ContactContact::all()->pluck('contact_first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.orderRoles.create', compact('orders', 'roles', 'contacts', 'users'));
    }

    public function store(StoreOrderRoleRequest $request)
    {
        $orderRole = OrderRole::create($request->all());

        return redirect()->route('admin.order-roles.index');
    }

    public function edit(OrderRole $orderRole)
    {
        abort_if(Gate::denies('order_role_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $orders = Order::all()->pluck('afa_order_num', 'id')->prepend(trans('global.pleaseSelect'), '');

        $roles = Role::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $contacts = ContactContact::all()->pluck('contact_first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $orderRole->load('order', 'role', 'contact', 'user');

        return view('admin.orderRoles.edit', compact('orders', 'roles', 'contacts', 'users', 'orderRole'));
    }

    public function update(UpdateOrderRoleRequest $request, OrderRole $orderRole)
    {
        $orderRole->update($request->all());

        return redirect()->route('admin.order-roles.index');
    }

    public function show(OrderRole $orderRole)
    {
        abort_if(Gate::denies('order_role_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $orderRole->load('order', 'role', 'contact', 'user');

        return view('admin.orderRoles.show', compact('orderRole'));
    }

    public function destroy(OrderRole $orderRole)
    {
        abort_if(Gate::denies('order_role_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $orderRole->delete();

        return back();
    }

    public function massDestroy(MassDestroyOrderRoleRequest $request)
    {
        OrderRole::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
