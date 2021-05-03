<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreComponentPartRequest;
use App\Http\Requests\UpdateComponentPartRequest;
use App\Http\Resources\Admin\ComponentPartResource;
use App\Models\ComponentPart;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ComponentPartsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('component_part_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ComponentPartResource(ComponentPart::with(['product_sku', 'component_part_name', 'raw_material', 'primary_suppliers', 'default_product_group'])->get());
    }

    public function store(StoreComponentPartRequest $request)
    {
        $componentPart = ComponentPart::create($request->all());
        $componentPart->primary_suppliers()->sync($request->input('primary_suppliers', []));

        return (new ComponentPartResource($componentPart))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ComponentPart $componentPart)
    {
        abort_if(Gate::denies('component_part_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ComponentPartResource($componentPart->load(['product_sku', 'component_part_name', 'raw_material', 'primary_suppliers', 'default_product_group']));
    }

    public function update(UpdateComponentPartRequest $request, ComponentPart $componentPart)
    {
        $componentPart->update($request->all());
        $componentPart->primary_suppliers()->sync($request->input('primary_suppliers', []));

        return (new ComponentPartResource($componentPart))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ComponentPart $componentPart)
    {
        abort_if(Gate::denies('component_part_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $componentPart->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
