<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyOrdertypeRequest;
use App\Http\Requests\StoreOrdertypeRequest;
use App\Http\Requests\UpdateOrdertypeRequest;
use App\Models\Ordertype;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class OrdertypeController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('ordertype_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Ordertype::query()->select(sprintf('%s.*', (new Ordertype())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'ordertype_show';
                $editGate = 'ordertype_edit';
                $deleteGate = 'ordertype_delete';
                $crudRoutePart = 'ordertypes';

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
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.ordertypes.index');
    }

    public function create()
    {
        abort_if(Gate::denies('ordertype_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.ordertypes.create');
    }

    public function store(StoreOrdertypeRequest $request)
    {
        $ordertype = Ordertype::create($request->all());

        return redirect()->route('admin.ordertypes.index');
    }

    public function edit(Ordertype $ordertype)
    {
        abort_if(Gate::denies('ordertype_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.ordertypes.edit', compact('ordertype'));
    }

    public function update(UpdateOrdertypeRequest $request, Ordertype $ordertype)
    {
        $ordertype->update($request->all());

        return redirect()->route('admin.ordertypes.index');
    }

    public function show(Ordertype $ordertype)
    {
        abort_if(Gate::denies('ordertype_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ordertype->load('orderTypeOrders');

        return view('admin.ordertypes.show', compact('ordertype'));
    }

    public function destroy(Ordertype $ordertype)
    {
        abort_if(Gate::denies('ordertype_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ordertype->delete();

        return back();
    }

    public function massDestroy(MassDestroyOrdertypeRequest $request)
    {
        Ordertype::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
