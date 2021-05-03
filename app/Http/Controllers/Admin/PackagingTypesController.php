<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyPackagingTypeRequest;
use App\Http\Requests\StorePackagingTypeRequest;
use App\Http\Requests\UpdatePackagingTypeRequest;
use App\Models\PackagingType;
use App\Models\RawMaterial;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PackagingTypesController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('packaging_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = PackagingType::with(['primary_material'])->select(sprintf('%s.*', (new PackagingType())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'packaging_type_show';
                $editGate = 'packaging_type_edit';
                $deleteGate = 'packaging_type_delete';
                $crudRoutePart = 'packaging-types';

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
            $table->addColumn('primary_material_name', function ($row) {
                return $row->primary_material ? $row->primary_material->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'primary_material']);

            return $table->make(true);
        }

        $raw_materials = RawMaterial::get();

        return view('admin.packagingTypes.index', compact('raw_materials'));
    }

    public function create()
    {
        abort_if(Gate::denies('packaging_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $primary_materials = RawMaterial::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.packagingTypes.create', compact('primary_materials'));
    }

    public function store(StorePackagingTypeRequest $request)
    {
        $packagingType = PackagingType::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $packagingType->id]);
        }

        return redirect()->route('admin.packaging-types.index');
    }

    public function edit(PackagingType $packagingType)
    {
        abort_if(Gate::denies('packaging_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $primary_materials = RawMaterial::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $packagingType->load('primary_material');

        return view('admin.packagingTypes.edit', compact('primary_materials', 'packagingType'));
    }

    public function update(UpdatePackagingTypeRequest $request, PackagingType $packagingType)
    {
        $packagingType->update($request->all());

        return redirect()->route('admin.packaging-types.index');
    }

    public function show(PackagingType $packagingType)
    {
        abort_if(Gate::denies('packaging_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $packagingType->load('primary_material', 'typePackagings', 'packagingTypeOrders');

        return view('admin.packagingTypes.show', compact('packagingType'));
    }

    public function destroy(PackagingType $packagingType)
    {
        abort_if(Gate::denies('packaging_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $packagingType->delete();

        return back();
    }

    public function massDestroy(MassDestroyPackagingTypeRequest $request)
    {
        PackagingType::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('packaging_type_create') && Gate::denies('packaging_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new PackagingType();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
