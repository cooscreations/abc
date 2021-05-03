<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyOrdertypeRequest;
use App\Http\Requests\StoreOrdertypeRequest;
use App\Http\Requests\UpdateOrdertypeRequest;
use App\Models\Ordertype;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OrdertypeController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('ordertype_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ordertypes = Ordertype::all();

        return view('frontend.ordertypes.index', compact('ordertypes'));
    }

    public function create()
    {
        abort_if(Gate::denies('ordertype_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.ordertypes.create');
    }

    public function store(StoreOrdertypeRequest $request)
    {
        $ordertype = Ordertype::create($request->all());

        return redirect()->route('frontend.ordertypes.index');
    }

    public function edit(Ordertype $ordertype)
    {
        abort_if(Gate::denies('ordertype_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.ordertypes.edit', compact('ordertype'));
    }

    public function update(UpdateOrdertypeRequest $request, Ordertype $ordertype)
    {
        $ordertype->update($request->all());

        return redirect()->route('frontend.ordertypes.index');
    }

    public function show(Ordertype $ordertype)
    {
        abort_if(Gate::denies('ordertype_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ordertype->load('orderTypeOrders');

        return view('frontend.ordertypes.show', compact('ordertype'));
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
