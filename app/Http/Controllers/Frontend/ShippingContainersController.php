<?php

namespace App\Http\Controllers\Frontend;

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

class ShippingContainersController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('shipping_container_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $shippingContainers = ShippingContainer::with(['order', 'shipping_company'])->get();

        $orders = Order::get();

        $contact_companies = ContactCompany::get();

        return view('frontend.shippingContainers.index', compact('shippingContainers', 'orders', 'contact_companies'));
    }

    public function create()
    {
        abort_if(Gate::denies('shipping_container_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $orders = Order::all()->pluck('afa_order_num', 'id')->prepend(trans('global.pleaseSelect'), '');

        $shipping_companies = ContactCompany::all()->pluck('company_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.shippingContainers.create', compact('orders', 'shipping_companies'));
    }

    public function store(StoreShippingContainerRequest $request)
    {
        $shippingContainer = ShippingContainer::create($request->all());

        return redirect()->route('frontend.shipping-containers.index');
    }

    public function edit(ShippingContainer $shippingContainer)
    {
        abort_if(Gate::denies('shipping_container_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $orders = Order::all()->pluck('afa_order_num', 'id')->prepend(trans('global.pleaseSelect'), '');

        $shipping_companies = ContactCompany::all()->pluck('company_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $shippingContainer->load('order', 'shipping_company');

        return view('frontend.shippingContainers.edit', compact('orders', 'shipping_companies', 'shippingContainer'));
    }

    public function update(UpdateShippingContainerRequest $request, ShippingContainer $shippingContainer)
    {
        $shippingContainer->update($request->all());

        return redirect()->route('frontend.shipping-containers.index');
    }

    public function show(ShippingContainer $shippingContainer)
    {
        abort_if(Gate::denies('shipping_container_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $shippingContainer->load('order', 'shipping_company');

        return view('frontend.shippingContainers.show', compact('shippingContainer'));
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
