<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRoleRequest;
use App\Http\Requests\UpdateOrderRoleRequest;
use App\Http\Resources\Admin\OrderRoleResource;
use App\Models\OrderRole;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OrderRolesApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('order_role_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new OrderRoleResource(OrderRole::with(['order', 'role', 'contact', 'user'])->get());
    }

    public function store(StoreOrderRoleRequest $request)
    {
        $orderRole = OrderRole::create($request->all());

        return (new OrderRoleResource($orderRole))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(OrderRole $orderRole)
    {
        abort_if(Gate::denies('order_role_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new OrderRoleResource($orderRole->load(['order', 'role', 'contact', 'user']));
    }

    public function update(UpdateOrderRoleRequest $request, OrderRole $orderRole)
    {
        $orderRole->update($request->all());

        return (new OrderRoleResource($orderRole))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(OrderRole $orderRole)
    {
        abort_if(Gate::denies('order_role_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $orderRole->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
