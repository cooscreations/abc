<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreComponentPartNameRequest;
use App\Http\Requests\UpdateComponentPartNameRequest;
use App\Http\Resources\Admin\ComponentPartNameResource;
use App\Models\ComponentPartName;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ComponentPartNamesApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('component_part_name_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ComponentPartNameResource(ComponentPartName::all());
    }

    public function store(StoreComponentPartNameRequest $request)
    {
        $componentPartName = ComponentPartName::create($request->all());

        if ($request->input('photo', false)) {
            $componentPartName->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        return (new ComponentPartNameResource($componentPartName))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ComponentPartName $componentPartName)
    {
        abort_if(Gate::denies('component_part_name_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ComponentPartNameResource($componentPartName);
    }

    public function update(UpdateComponentPartNameRequest $request, ComponentPartName $componentPartName)
    {
        $componentPartName->update($request->all());

        if ($request->input('photo', false)) {
            if (!$componentPartName->photo || $request->input('photo') !== $componentPartName->photo->file_name) {
                if ($componentPartName->photo) {
                    $componentPartName->photo->delete();
                }
                $componentPartName->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
            }
        } elseif ($componentPartName->photo) {
            $componentPartName->photo->delete();
        }

        return (new ComponentPartNameResource($componentPartName))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ComponentPartName $componentPartName)
    {
        abort_if(Gate::denies('component_part_name_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $componentPartName->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
