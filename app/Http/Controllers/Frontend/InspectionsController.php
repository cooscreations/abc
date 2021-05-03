<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyInspectionRequest;
use App\Http\Requests\StoreInspectionRequest;
use App\Http\Requests\UpdateInspectionRequest;
use App\Models\AfaStaff;
use App\Models\ContactCompany;
use App\Models\Inspection;
use App\Models\InspectionStatus;
use App\Models\Order;
use App\Models\OrderItem;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class InspectionsController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('inspection_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $inspections = Inspection::with(['order', 'inspector_name', 'customer', 'order_follower', 'supplier', 'order_item', 'qc_status', 'additional_q_cs'])->get();

        $orders = Order::get();

        $afa_staffs = AfaStaff::get();

        $contact_companies = ContactCompany::get();

        $order_items = OrderItem::get();

        $inspection_statuses = InspectionStatus::get();

        return view('frontend.inspections.index', compact('inspections', 'orders', 'afa_staffs', 'contact_companies', 'order_items', 'inspection_statuses'));
    }

    public function create()
    {
        abort_if(Gate::denies('inspection_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $orders = Order::all()->pluck('afa_order_num', 'id')->prepend(trans('global.pleaseSelect'), '');

        $inspector_names = AfaStaff::all()->pluck('full_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $customers = ContactCompany::all()->pluck('company_short_code', 'id')->prepend(trans('global.pleaseSelect'), '');

        $order_followers = AfaStaff::all()->pluck('full_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $suppliers = ContactCompany::all()->pluck('company_short_code', 'id')->prepend(trans('global.pleaseSelect'), '');

        $order_items = OrderItem::all()->pluck('quantity', 'id')->prepend(trans('global.pleaseSelect'), '');

        $qc_statuses = InspectionStatus::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $additional_q_cs = AfaStaff::all()->pluck('full_name', 'id');

        return view('frontend.inspections.create', compact('orders', 'inspector_names', 'customers', 'order_followers', 'suppliers', 'order_items', 'qc_statuses', 'additional_q_cs'));
    }

    public function store(StoreInspectionRequest $request)
    {
        $inspection = Inspection::create($request->all());
        $inspection->additional_q_cs()->sync($request->input('additional_q_cs', []));

        return redirect()->route('frontend.inspections.index');
    }

    public function edit(Inspection $inspection)
    {
        abort_if(Gate::denies('inspection_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $orders = Order::all()->pluck('afa_order_num', 'id')->prepend(trans('global.pleaseSelect'), '');

        $inspector_names = AfaStaff::all()->pluck('full_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $customers = ContactCompany::all()->pluck('company_short_code', 'id')->prepend(trans('global.pleaseSelect'), '');

        $order_followers = AfaStaff::all()->pluck('full_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $suppliers = ContactCompany::all()->pluck('company_short_code', 'id')->prepend(trans('global.pleaseSelect'), '');

        $order_items = OrderItem::all()->pluck('quantity', 'id')->prepend(trans('global.pleaseSelect'), '');

        $qc_statuses = InspectionStatus::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $additional_q_cs = AfaStaff::all()->pluck('full_name', 'id');

        $inspection->load('order', 'inspector_name', 'customer', 'order_follower', 'supplier', 'order_item', 'qc_status', 'additional_q_cs');

        return view('frontend.inspections.edit', compact('orders', 'inspector_names', 'customers', 'order_followers', 'suppliers', 'order_items', 'qc_statuses', 'additional_q_cs', 'inspection'));
    }

    public function update(UpdateInspectionRequest $request, Inspection $inspection)
    {
        $inspection->update($request->all());
        $inspection->additional_q_cs()->sync($request->input('additional_q_cs', []));

        return redirect()->route('frontend.inspections.index');
    }

    public function show(Inspection $inspection)
    {
        abort_if(Gate::denies('inspection_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $inspection->load('order', 'inspector_name', 'customer', 'order_follower', 'supplier', 'order_item', 'qc_status', 'additional_q_cs');

        return view('frontend.inspections.show', compact('inspection'));
    }

    public function destroy(Inspection $inspection)
    {
        abort_if(Gate::denies('inspection_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $inspection->delete();

        return back();
    }

    public function massDestroy(MassDestroyInspectionRequest $request)
    {
        Inspection::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
