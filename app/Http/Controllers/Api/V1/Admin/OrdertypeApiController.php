<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrdertypeRequest;
use App\Http\Requests\UpdateOrdertypeRequest;
use App\Http\Resources\Admin\OrdertypeResource;
use App\Models\Ordertype;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OrdertypeApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('ordertype_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new OrdertypeResource(Ordertype::all());
    }

    public function store(StoreOrdertypeRequest $request)
    {
        $ordertype = Ordertype::create($request->all());

        return (new OrdertypeResource($ordertype))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Ordertype $ordertype)
    {
        abort_if(Gate::denies('ordertype_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new OrdertypeResource($ordertype);
    }

    public function update(UpdateOrdertypeRequest $request, Ordertype $ordertype)
    {
        $ordertype->update($request->all());

        return (new OrdertypeResource($ordertype))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Ordertype $ordertype)
    {
        abort_if(Gate::denies('ordertype_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ordertype->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
