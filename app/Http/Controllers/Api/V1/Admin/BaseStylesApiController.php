<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBaseStyleRequest;
use App\Http\Requests\UpdateBaseStyleRequest;
use App\Http\Resources\Admin\BaseStyleResource;
use App\Models\BaseStyle;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BaseStylesApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('base_style_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BaseStyleResource(BaseStyle::all());
    }

    public function store(StoreBaseStyleRequest $request)
    {
        $baseStyle = BaseStyle::create($request->all());

        return (new BaseStyleResource($baseStyle))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(BaseStyle $baseStyle)
    {
        abort_if(Gate::denies('base_style_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BaseStyleResource($baseStyle);
    }

    public function update(UpdateBaseStyleRequest $request, BaseStyle $baseStyle)
    {
        $baseStyle->update($request->all());

        return (new BaseStyleResource($baseStyle))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(BaseStyle $baseStyle)
    {
        abort_if(Gate::denies('base_style_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $baseStyle->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
