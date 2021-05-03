<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreStorageOptionRequest;
use App\Http\Requests\UpdateStorageOptionRequest;
use App\Http\Resources\Admin\StorageOptionResource;
use App\Models\StorageOption;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StorageOptionsApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('storage_option_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new StorageOptionResource(StorageOption::all());
    }

    public function store(StoreStorageOptionRequest $request)
    {
        $storageOption = StorageOption::create($request->all());

        return (new StorageOptionResource($storageOption))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(StorageOption $storageOption)
    {
        abort_if(Gate::denies('storage_option_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new StorageOptionResource($storageOption);
    }

    public function update(UpdateStorageOptionRequest $request, StorageOption $storageOption)
    {
        $storageOption->update($request->all());

        return (new StorageOptionResource($storageOption))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(StorageOption $storageOption)
    {
        abort_if(Gate::denies('storage_option_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $storageOption->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
