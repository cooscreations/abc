<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFabricNicknameRequest;
use App\Http\Requests\UpdateFabricNicknameRequest;
use App\Http\Resources\Admin\FabricNicknameResource;
use App\Models\FabricNickname;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FabricNicknamesApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('fabric_nickname_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FabricNicknameResource(FabricNickname::with(['fabric', 'customer'])->get());
    }

    public function store(StoreFabricNicknameRequest $request)
    {
        $fabricNickname = FabricNickname::create($request->all());

        return (new FabricNicknameResource($fabricNickname))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(FabricNickname $fabricNickname)
    {
        abort_if(Gate::denies('fabric_nickname_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FabricNicknameResource($fabricNickname->load(['fabric', 'customer']));
    }

    public function update(UpdateFabricNicknameRequest $request, FabricNickname $fabricNickname)
    {
        $fabricNickname->update($request->all());

        return (new FabricNicknameResource($fabricNickname))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(FabricNickname $fabricNickname)
    {
        abort_if(Gate::denies('fabric_nickname_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fabricNickname->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
