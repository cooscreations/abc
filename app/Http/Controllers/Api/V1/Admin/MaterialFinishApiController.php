<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreMaterialFinishRequest;
use App\Http\Requests\UpdateMaterialFinishRequest;
use App\Http\Resources\Admin\MaterialFinishResource;
use App\Models\MaterialFinish;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MaterialFinishApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('material_finish_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MaterialFinishResource(MaterialFinish::all());
    }

    public function store(StoreMaterialFinishRequest $request)
    {
        $materialFinish = MaterialFinish::create($request->all());

        if ($request->input('photos', false)) {
            $materialFinish->addMedia(storage_path('tmp/uploads/' . basename($request->input('photos'))))->toMediaCollection('photos');
        }

        return (new MaterialFinishResource($materialFinish))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(MaterialFinish $materialFinish)
    {
        abort_if(Gate::denies('material_finish_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MaterialFinishResource($materialFinish);
    }

    public function update(UpdateMaterialFinishRequest $request, MaterialFinish $materialFinish)
    {
        $materialFinish->update($request->all());

        if ($request->input('photos', false)) {
            if (!$materialFinish->photos || $request->input('photos') !== $materialFinish->photos->file_name) {
                if ($materialFinish->photos) {
                    $materialFinish->photos->delete();
                }
                $materialFinish->addMedia(storage_path('tmp/uploads/' . basename($request->input('photos'))))->toMediaCollection('photos');
            }
        } elseif ($materialFinish->photos) {
            $materialFinish->photos->delete();
        }

        return (new MaterialFinishResource($materialFinish))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(MaterialFinish $materialFinish)
    {
        abort_if(Gate::denies('material_finish_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $materialFinish->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
