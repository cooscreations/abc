<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyRawMaterialTypeRequest;
use App\Http\Requests\StoreRawMaterialTypeRequest;
use App\Http\Requests\UpdateRawMaterialTypeRequest;
use App\Models\RawMaterialType;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class RawMaterialTypesController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('raw_material_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = RawMaterialType::query()->select(sprintf('%s.*', (new RawMaterialType())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'raw_material_type_show';
                $editGate = 'raw_material_type_edit';
                $deleteGate = 'raw_material_type_delete';
                $crudRoutePart = 'raw-material-types';

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
            $table->editColumn('public_url', function ($row) {
                return $row->public_url ? $row->public_url : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.rawMaterialTypes.index');
    }

    public function create()
    {
        abort_if(Gate::denies('raw_material_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.rawMaterialTypes.create');
    }

    public function store(StoreRawMaterialTypeRequest $request)
    {
        $rawMaterialType = RawMaterialType::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $rawMaterialType->id]);
        }

        return redirect()->route('admin.raw-material-types.index');
    }

    public function edit(RawMaterialType $rawMaterialType)
    {
        abort_if(Gate::denies('raw_material_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.rawMaterialTypes.edit', compact('rawMaterialType'));
    }

    public function update(UpdateRawMaterialTypeRequest $request, RawMaterialType $rawMaterialType)
    {
        $rawMaterialType->update($request->all());

        return redirect()->route('admin.raw-material-types.index');
    }

    public function show(RawMaterialType $rawMaterialType)
    {
        abort_if(Gate::denies('raw_material_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.rawMaterialTypes.show', compact('rawMaterialType'));
    }

    public function destroy(RawMaterialType $rawMaterialType)
    {
        abort_if(Gate::denies('raw_material_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rawMaterialType->delete();

        return back();
    }

    public function massDestroy(MassDestroyRawMaterialTypeRequest $request)
    {
        RawMaterialType::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('raw_material_type_create') && Gate::denies('raw_material_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new RawMaterialType();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
