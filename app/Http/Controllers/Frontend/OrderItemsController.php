<?php

namespace App\Http\Controllers\Frontend;

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

class OrderItemsController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('order_item_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $orderItems = OrderItem::with(['order', 'product', 'product_sku'])->get();

        $orders = Order::get();

        $products = Product::get();

        $product_skus = ProductSku::get();

        return view('frontend.orderItems.index', compact('orderItems', 'orders', 'products', 'product_skus'));
    }

    public function create()
    {
        abort_if(Gate::denies('order_item_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $orders = Order::all()->pluck('afa_order_num', 'id')->prepend(trans('global.pleaseSelect'), '');

        $products = Product::all()->pluck('afa_model_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        $product_skus = ProductSku::all()->pluck('product_sku', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.orderItems.create', compact('orders', 'products', 'product_skus'));
    }

    public function store(StoreOrderItemRequest $request)
    {
        $orderItem = OrderItem::create($request->all());

        return redirect()->route('frontend.order-items.index');
    }

    public function edit(OrderItem $orderItem)
    {
        abort_if(Gate::denies('order_item_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $orders = Order::all()->pluck('afa_order_num', 'id')->prepend(trans('global.pleaseSelect'), '');

        $products = Product::all()->pluck('afa_model_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        $product_skus = ProductSku::all()->pluck('product_sku', 'id')->prepend(trans('global.pleaseSelect'), '');

        $orderItem->load('order', 'product', 'product_sku');

        return view('frontend.orderItems.edit', compact('orders', 'products', 'product_skus', 'orderItem'));
    }

    public function update(UpdateOrderItemRequest $request, OrderItem $orderItem)
    {
        $orderItem->update($request->all());

        return redirect()->route('frontend.order-items.index');
    }

    public function show(OrderItem $orderItem)
    {
        abort_if(Gate::denies('order_item_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $orderItem->load('order', 'product', 'product_sku', 'orderItemInspections');

        return view('frontend.orderItems.show', compact('orderItem'));
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
