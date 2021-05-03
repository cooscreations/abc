<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFileTypeRequest;
use App\Http\Requests\UpdateFileTypeRequest;
use App\Http\Resources\Admin\FileTypeResource;
use App\Models\FileType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FileTypesApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('file_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FileTypeResource(FileType::all());
    }

    public function store(StoreFileTypeRequest $request)
    {
        $fileType = FileType::create($request->all());

        return (new FileTypeResource($fileType))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(FileType $fileType)
    {
        abort_if(Gate::denies('file_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FileTypeResource($fileType);
    }

    public function update(UpdateFileTypeRequest $request, FileType $fileType)
    {
        $fileType->update($request->all());

        return (new FileTypeResource($fileType))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(FileType $fileType)
    {
        abort_if(Gate::denies('file_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fileType->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
