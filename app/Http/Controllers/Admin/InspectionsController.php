<?php

namespace App\Http\Controllers\Admin;

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
use Yajra\DataTables\Facades\DataTables;

class InspectionsController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('inspection_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Inspection::with(['order', 'inspector_name', 'customer', 'order_follower', 'supplier', 'order_item', 'qc_status', 'additional_q_cs'])->select(sprintf('%s.*', (new Inspection())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'inspection_show';
                $editGate = 'inspection_edit';
                $deleteGate = 'inspection_delete';
                $crudRoutePart = 'inspections';

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

            $table->addColumn('inspector_name_full_name', function ($row) {
                return $row->inspector_name ? $row->inspector_name->full_name : '';
            });

            $table->addColumn('customer_company_short_code', function ($row) {
                return $row->customer ? $row->customer->company_short_code : '';
            });

            $table->addColumn('supplier_company_short_code', function ($row) {
                return $row->supplier ? $row->supplier->company_short_code : '';
            });

            $table->addColumn('qc_status_name', function ($row) {
                return $row->qc_status ? $row->qc_status->name : '';
            });

            $table->editColumn('qc_status.list_order', function ($row) {
                return $row->qc_status ? (is_string($row->qc_status) ? $row->qc_status : $row->qc_status->list_order) : '';
            });
            $table->editColumn('qty_inspected', function ($row) {
                return $row->qty_inspected ? $row->qty_inspected : '';
            });
            $table->editColumn('inspection_passed', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->inspection_passed ? 'checked' : null) . '>';
            });

            $table->rawColumns(['actions', 'placeholder', 'order', 'inspector_name', 'customer', 'supplier', 'qc_status', 'inspection_passed']);

            return $table->make(true);
        }

        $orders              = Order::get();
        $afa_staffs          = AfaStaff::get();
        $contact_companies   = ContactCompany::get();
        $order_items         = OrderItem::get();
        $inspection_statuses = InspectionStatus::get();

        return view('admin.inspections.index', compact('orders', 'afa_staffs', 'contact_companies', 'order_items', 'inspection_statuses'));
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

        return view('admin.inspections.create', compact('orders', 'inspector_names', 'customers', 'order_followers', 'suppliers', 'order_items', 'qc_statuses', 'additional_q_cs'));
    }

    public function store(StoreInspectionRequest $request)
    {
        $inspection = Inspection::create($request->all());
        $inspection->additional_q_cs()->sync($request->input('additional_q_cs', []));

        return redirect()->route('admin.inspections.index');
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

        return view('admin.inspections.edit', compact('orders', 'inspector_names', 'customers', 'order_followers', 'suppliers', 'order_items', 'qc_statuses', 'additional_q_cs', 'inspection'));
    }

    public function update(UpdateInspectionRequest $request, Inspection $inspection)
    {
        $inspection->update($request->all());
        $inspection->additional_q_cs()->sync($request->input('additional_q_cs', []));

        return redirect()->route('admin.inspections.index');
    }

    public function show(Inspection $inspection)
    {
        abort_if(Gate::denies('inspection_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $inspection->load('order', 'inspector_name', 'customer', 'order_follower', 'supplier', 'order_item', 'qc_status', 'additional_q_cs');

        return view('admin.inspections.show', compact('inspection'));
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
