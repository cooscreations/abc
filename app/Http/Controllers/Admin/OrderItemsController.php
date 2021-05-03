<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyOrderItemRequest;
use App\Http\Requests\StoreOrderItemRequest;
use App\Http\Requests\UpdateOrderItemRequest;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductSku;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class OrderItemsController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('order_item_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = OrderItem::with(['order', 'product', 'product_sku'])->select(sprintf('%s.*', (new OrderItem())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'order_item_show';
                $editGate = 'order_item_edit';
                $deleteGate = 'order_item_delete';
                $crudRoutePart = 'order-items';

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
            $table->addColumn('order_afa_order_num', function ($row) {
                return $row->order ? $row->order->afa_order_num : '';
            });

            $table->editColumn('order.customer_order_number', function ($row) {
                return $row->order ? (is_string($row->order) ? $row->order : $row->order->customer_order_number) : '';
            });
            $table->editColumn('quantity', function ($row) {
                return $row->quantity ? $row->quantity : '';
            });
            $table->addColumn('product_afa_model_number', function ($row) {
                return $row->product ? $row->product->afa_model_number : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'order', 'product']);

            return $table->make(true);
        }

        $orders       = Order::get();
        $products     = Product::get();
        $product_skus = ProductSku::get();

        return view('admin.orderItems.index', compact('orders', 'products', 'product_skus'));
    }

    public function create()
    {
        abort_if(Gate::denies('order_item_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $orders = Order::all()->pluck('afa_order_num', 'id')->prepend(trans('global.pleaseSelect'), '');

        $products = Product::all()->pluck('afa_model_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        $product_skus = ProductSku::all()->pluck('product_sku', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.orderItems.create', compact('orders', 'products', 'product_skus'));
    }

    public function store(StoreOrderItemRequest $request)
    {
        $orderItem = OrderItem::create($request->all());

        return redirect()->route('admin.order-items.index');
    }

    public function edit(OrderItem $orderItem)
    {
        abort_if(Gate::denies('order_item_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $orders = Order::all()->pluck('afa_order_num', 'id')->prepend(trans('global.pleaseSelect'), '');

        $products = Product::all()->pluck('afa_model_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        $product_skus = ProductSku::all()->pluck('product_sku', 'id')->prepend(trans('global.pleaseSelect'), '');

        $orderItem->load('order', 'product', 'product_sku');

        return view('admin.orderItems.edit', compact('orders', 'products', 'product_skus', 'orderItem'));
    }

    public function update(UpdateOrderItemRequest $request, OrderItem $orderItem)
    {
        $orderItem->update($request->all());

        return redirect()->route('admin.order-items.index');
    }

    public function show(OrderItem $orderItem)
    {
        abort_if(Gate::denies('order_item_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $orderItem->load('order', 'product', 'product_sku', 'orderItemInspections');

        return view('admin.orderItems.show', compact('orderItem'));
    }

    public function destroy(OrderItem $orderItem)
    {
        abort_if(Gate::denies('order_item_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $orderItem->delete();

        return back();
    }

    public function massDestroy(MassDestroyOrderItemRequest $request)
    {
        OrderItem::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
