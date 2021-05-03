<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreVisitorBedConfigRequest;
use App\Http\Requests\UpdateVisitorBedConfigRequest;
use App\Http\Resources\Admin\VisitorBedConfigResource;
use App\Models\VisitorBedConfig;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VisitorBedConfigApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('visitor_bed_config_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new VisitorBedConfigResource(VisitorBedConfig::all());
    }

    public function store(StoreVisitorBedConfigRequest $request)
    {
        $visitorBedConfig = VisitorBedConfig::create($request->all());

        return (new VisitorBedConfigResource($visitorBedConfig))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(VisitorBedConfig $visitorBedConfig)
    {
        abort_if(Gate::denies('visitor_bed_config_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new VisitorBedConfigResource($visitorBedConfig);
    }

    public function update(UpdateVisitorBedConfigRequest $request, VisitorBedConfig $visitorBedConfig)
    {
        $visitorBedConfig->update($request->all());

        return (new VisitorBedConfigResource($visitorBedConfig))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(VisitorBedConfig $visitorBedConfig)
    {
        abort_if(Gate::denies('visitor_bed_config_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $visitorBedConfig->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
