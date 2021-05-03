<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyShippingContainerRequest;
use App\Http\Requests\StoreShippingContainerRequest;
use App\Http\Requests\UpdateShippingContainerRequest;
use App\Models\ContactCompany;
use App\Models\Order;
use App\Models\ShippingContainer;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ShippingContainersController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('shipping_container_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ShippingContainer::with(['order', 'shipping_company'])->select(sprintf('%s.*', (new ShippingContainer())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'shipping_container_show';
                $editGate = 'shipping_container_edit';
                $deleteGate = 'shipping_container_delete';
                $crudRoutePart = 'shipping-containers';

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
            $table->editColumn('container_number', function ($row) {
                return $row->container_number ? $row->container_number : '';
            });
            $table->addColumn('order_afa_order_num', function ($row) {
                return $row->order ? $row->order->afa_order_num : '';
            });

            $table->editColumn('order.afa_order_num', function ($row) {
                return $row->order ? (is_string($row->order) ? $row->order : $row->order->afa_order_num) : '';
            });
            $table->addColumn('shipping_company_company_name', function ($row) {
                return $row->shipping_company ? $row->shipping_company->company_name : '';
            });

            $table->editColumn('shipping_company.company_short_code', function ($row) {
                return $row->shipping_company ? (is_string($row->shipping_company) ? $row->shipping_company : $row->shipping_company->company_short_code) : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'order', 'shipping_company']);

            return $table->make(true);
        }

        $orders            = Order::get();
        $contact_companies = ContactCompany::get();

        return view('admin.shippingContainers.index', compact('orders', 'contact_companies'));
    }

    public function create()
    {
        abort_if(Gate::denies('shipping_container_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $orders = Order::all()->pluck('afa_order_num', 'id')->prepend(trans('global.pleaseSelect'), '');

        $shipping_companies = ContactCompany::all()->pluck('company_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.shippingContainers.create', compact('orders', 'shipping_companies'));
    }

    public function store(StoreShippingContainerRequest $request)
    {
        $shippingContainer = ShippingContainer::create($request->all());

        return redirect()->route('admin.shipping-containers.index');
    }

    public function edit(ShippingContainer $shippingContainer)
    {
        abort_if(Gate::denies('shipping_container_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $orders = Order::all()->pluck('afa_order_num', 'id')->prepend(trans('global.pleaseSelect'), '');

        $shipping_companies = ContactCompany::all()->pluck('company_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $shippingContainer->load('order', 'shipping_company');

        return view('admin.shippingContainers.edit', compact('orders', 'shipping_companies', 'shippingContainer'));
    }

    public function update(UpdateShippingContainerRequest $request, ShippingContainer $shippingContainer)
    {
        $shippingContainer->update($request->all());

        return redirect()->route('admin.shipping-containers.index');
    }

    public function show(ShippingContainer $shippingContainer)
    {
        abort_if(Gate::denies('shipping_container_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $shippingContainer->load('order', 'shipping_company');

        return view('admin.shippingContainers.show', compact('shippingContainer'));
    }

    public function destroy(ShippingContainer $shippingContainer)
    {
        abort_if(Gate::denies('shipping_container_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $shippingContainer->delete();

        return back();
    }

    public function massDestroy(MassDestroyShippingContainerRequest $request)
    {
        ShippingContainer::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
