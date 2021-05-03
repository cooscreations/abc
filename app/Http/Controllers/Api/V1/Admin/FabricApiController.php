<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFabricRequest;
use App\Http\Requests\UpdateFabricRequest;
use App\Http\Resources\Admin\FabricResource;
use App\Models\Fabric;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FabricApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('fabric_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FabricResource(Fabric::with(['fabric_group'])->get());
    }

    public function store(StoreFabricRequest $request)
    {
        $fabric = Fabric::create($request->all());

        return (new FabricResource($fabric))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Fabric $fabric)
    {
        abort_if(Gate::denies('fabric_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FabricResource($fabric->load(['fabric_group']));
    }

    public function update(UpdateFabricRequest $request, Fabric $fabric)
    {
        $fabric->update($request->all());

        return (new FabricResource($fabric))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Fabric $fabric)
    {
        abort_if(Gate::denies('fabric_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fabric->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
