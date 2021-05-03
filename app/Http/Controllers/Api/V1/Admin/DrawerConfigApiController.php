<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreDrawerConfigRequest;
use App\Http\Requests\UpdateDrawerConfigRequest;
use App\Http\Resources\Admin\DrawerConfigResource;
use App\Models\DrawerConfig;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DrawerConfigApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('drawer_config_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DrawerConfigResource(DrawerConfig::all());
    }

    public function store(StoreDrawerConfigRequest $request)
    {
        $drawerConfig = DrawerConfig::create($request->all());

        if ($request->input('photo', false)) {
            $drawerConfig->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        return (new DrawerConfigResource($drawerConfig))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(DrawerConfig $drawerConfig)
    {
        abort_if(Gate::denies('drawer_config_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DrawerConfigResource($drawerConfig);
    }

    public function update(UpdateDrawerConfigRequest $request, DrawerConfig $drawerConfig)
    {
        $drawerConfig->update($request->all());

        if ($request->input('photo', false)) {
            if (!$drawerConfig->photo || $request->input('photo') !== $drawerConfig->photo->file_name) {
                if ($drawerConfig->photo) {
                    $drawerConfig->photo->delete();
                }
                $drawerConfig->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
            }
        } elseif ($drawerConfig->photo) {
            $drawerConfig->photo->delete();
        }

        return (new DrawerConfigResource($drawerConfig))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(DrawerConfig $drawerConfig)
    {
        abort_if(Gate::denies('drawer_config_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $drawerConfig->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
