<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreYesNoMaybeRequest;
use App\Http\Requests\UpdateYesNoMaybeRequest;
use App\Http\Resources\Admin\YesNoMaybeResource;
use App\Models\YesNoMaybe;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class YesNoMaybeApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('yes_no_maybe_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new YesNoMaybeResource(YesNoMaybe::all());
    }

    public function store(StoreYesNoMaybeRequest $request)
    {
        $yesNoMaybe = YesNoMaybe::create($request->all());

        return (new YesNoMaybeResource($yesNoMaybe))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(YesNoMaybe $yesNoMaybe)
    {
        abort_if(Gate::denies('yes_no_maybe_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new YesNoMaybeResource($yesNoMaybe);
    }

    public function update(UpdateYesNoMaybeRequest $request, YesNoMaybe $yesNoMaybe)
    {
        $yesNoMaybe->update($request->all());

        return (new YesNoMaybeResource($yesNoMaybe))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(YesNoMaybe $yesNoMaybe)
    {
        abort_if(Gate::denies('yes_no_maybe_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $yesNoMaybe->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
