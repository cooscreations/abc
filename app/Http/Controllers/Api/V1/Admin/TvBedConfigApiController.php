<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreTvBedConfigRequest;
use App\Http\Requests\UpdateTvBedConfigRequest;
use App\Http\Resources\Admin\TvBedConfigResource;
use App\Models\TvBedConfig;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TvBedConfigApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('tv_bed_config_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TvBedConfigResource(TvBedConfig::all());
    }

    public function store(StoreTvBedConfigRequest $request)
    {
        $tvBedConfig = TvBedConfig::create($request->all());

        return (new TvBedConfigResource($tvBedConfig))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(TvBedConfig $tvBedConfig)
    {
        abort_if(Gate::denies('tv_bed_config_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TvBedConfigResource($tvBedConfig);
    }

    public function update(UpdateTvBedConfigRequest $request, TvBedConfig $tvBedConfig)
    {
        $tvBedConfig->update($request->all());

        return (new TvBedConfigResource($tvBedConfig))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(TvBedConfig $tvBedConfig)
    {
        abort_if(Gate::denies('tv_bed_config_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tvBedConfig->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
