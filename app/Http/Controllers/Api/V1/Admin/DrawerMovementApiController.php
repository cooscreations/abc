<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDrawerMovementRequest;
use App\Http\Requests\UpdateDrawerMovementRequest;
use App\Http\Resources\Admin\DrawerMovementResource;
use App\Models\DrawerMovement;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DrawerMovementApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('drawer_movement_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DrawerMovementResource(DrawerMovement::all());
    }

    public function store(StoreDrawerMovementRequest $request)
    {
        $drawerMovement = DrawerMovement::create($request->all());

        return (new DrawerMovementResource($drawerMovement))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(DrawerMovement $drawerMovement)
    {
        abort_if(Gate::denies('drawer_movement_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DrawerMovementResource($drawerMovement);
    }

    public function update(UpdateDrawerMovementRequest $request, DrawerMovement $drawerMovement)
    {
        $drawerMovement->update($request->all());

        return (new DrawerMovementResource($drawerMovement))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(DrawerMovement $drawerMovement)
    {
        abort_if(Gate::denies('drawer_movement_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $drawerMovement->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
