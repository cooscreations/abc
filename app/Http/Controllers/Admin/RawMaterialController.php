<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyRawMaterialRequest;
use App\Http\Requests\StoreRawMaterialRequest;
use App\Http\Requests\UpdateRawMaterialRequest;
use App\Models\MaterialFinish;
use App\Models\RawMaterial;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class RawMaterialController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('raw_material_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = RawMaterial::with(['std_material_finish'])->select(sprintf('%s.*', (new RawMaterial())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'raw_material_show';
                $editGate = 'raw_material_edit';
                $deleteGate = 'raw_material_delete';
                $crudRoutePart = 'raw-materials';

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
            $table->addColumn('std_material_finish_name', function ($row) {
                return $row->std_material_finish ? $row->std_material_finish->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'std_material_finish']);

            return $table->make(true);
        }

        return view('admin.rawMaterials.index');
    }

    public function create()
    {
        abort_if(Gate::denies('raw_material_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $std_material_finishes = MaterialFinish::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.rawMaterials.create', compact('std_material_finishes'));
    }

    public function store(StoreRawMaterialRequest $request)
    {
        $rawMaterial = RawMaterial::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $rawMaterial->id]);
        }

        return redirect()->route('admin.raw-materials.index');
    }

    public function edit(RawMaterial $rawMaterial)
    {
        abort_if(Gate::denies('raw_material_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $std_material_finishes = MaterialFinish::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $rawMaterial->load('std_material_finish');

        return view('admin.rawMaterials.edit', compact('std_material_finishes', 'rawMaterial'));
    }

    public function update(UpdateRawMaterialRequest $request, RawMaterial $rawMaterial)
    {
        $rawMaterial->update($request->all());

        return redirect()->route('admin.raw-materials.index');
    }

    public function show(RawMaterial $rawMaterial)
    {
        abort_if(Gate::denies('raw_material_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rawMaterial->load('std_material_finish', 'primaryMaterialPackagingTypes', 'defaultRawMaterialPrices', 'primaryMaterialProducts', 'rawMaterialComponentParts', 'primaryMaterialsSupplierAudits');

        return view('admin.rawMaterials.show', compact('rawMaterial'));
    }

    public function destroy(RawMaterial $rawMaterial)
    {
        abort_if(Gate::denies('raw_material_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rawMaterial->delete();

        return back();
    }

    public function massDestroy(MassDestroyRawMaterialRequest $request)
    {
        RawMaterial::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('raw_material_create') && Gate::denies('raw_material_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new RawMaterial();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
