<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyFileTypeRequest;
use App\Http\Requests\StoreFileTypeRequest;
use App\Http\Requests\UpdateFileTypeRequest;
use App\Models\FileType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FileTypesController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('file_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fileTypes = FileType::all();

        return view('frontend.fileTypes.index', compact('fileTypes'));
    }

    public function create()
    {
        abort_if(Gate::denies('file_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.fileTypes.create');
    }

    public function store(StoreFileTypeRequest $request)
    {
        $fileType = FileType::create($request->all());

        return redirect()->route('frontend.file-types.index');
    }

    public function edit(FileType $fileType)
    {
        abort_if(Gate::denies('file_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.fileTypes.edit', compact('fileType'));
    }

    public function update(UpdateFileTypeRequest $request, FileType $fileType)
    {
        $fileType->update($request->all());

        return redirect()->route('frontend.file-types.index');
    }

    public function show(FileType $fileType)
    {
        abort_if(Gate::denies('file_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fileType->load('fileTypeDocuments');

        return view('frontend.fileTypes.show', compact('fileType'));
    }

    public function destroy(FileType $fileType)
    {
        abort_if(Gate::denies('file_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fileType->delete();

        return back();
    }

    public function massDestroy(MassDestroyFileTypeRequest $request)
    {
        FileType::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
