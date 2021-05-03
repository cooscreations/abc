<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyFileTypeRequest;
use App\Http\Requests\StoreFileTypeRequest;
use App\Http\Requests\UpdateFileTypeRequest;
use App\Models\FileType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class FileTypesController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('file_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = FileType::query()->select(sprintf('%s.*', (new FileType())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'file_type_show';
                $editGate = 'file_type_edit';
                $deleteGate = 'file_type_delete';
                $crudRoutePart = 'file-types';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('icon', function ($row) {
                return $row->icon ? $row->icon : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.fileTypes.index');
    }

    public function create()
    {
        abort_if(Gate::denies('file_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.fileTypes.create');
    }

    public function store(StoreFileTypeRequest $request)
    {
        $fileType = FileType::create($request->all());

        return redirect()->route('admin.file-types.index');
    }

    public function edit(FileType $fileType)
    {
        abort_if(Gate::denies('file_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.fileTypes.edit', compact('fileType'));
    }

    public function update(UpdateFileTypeRequest $request, FileType $fileType)
    {
        $fileType->update($request->all());

        return redirect()->route('admin.file-types.index');
    }

    public function show(FileType $fileType)
    {
        abort_if(Gate::denies('file_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fileType->load('fileTypeDocuments');

        return view('admin.fileTypes.show', compact('fileType'));
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
