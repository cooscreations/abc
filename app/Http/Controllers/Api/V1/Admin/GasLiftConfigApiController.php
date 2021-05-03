<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreGasLiftConfigRequest;
use App\Http\Requests\UpdateGasLiftConfigRequest;
use App\Http\Resources\Admin\GasLiftConfigResource;
use App\Models\GasLiftConfig;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GasLiftConfigApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('gas_lift_config_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new GasLiftConfigResource(GasLiftConfig::all());
    }

    public function store(StoreGasLiftConfigRequest $request)
    {
        $gasLiftConfig = GasLiftConfig::create($request->all());

        return (new GasLiftConfigResource($gasLiftConfig))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(GasLiftConfig $gasLiftConfig)
    {
        abort_if(Gate::denies('gas_lift_config_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new GasLiftConfigResource($gasLiftConfig);
    }

    public function update(UpdateGasLiftConfigRequest $request, GasLiftConfig $gasLiftConfig)
    {
        $gasLiftConfig->update($request->all());

        return (new GasLiftConfigResource($gasLiftConfig))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(GasLiftConfig $gasLiftConfig)
    {
        abort_if(Gate::denies('gas_lift_config_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $gasLiftConfig->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
