<?php

namespace App\Http\Controllers\Frontend;

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

class RawMaterialTypesController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('raw_material_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rawMaterialTypes = RawMaterialType::all();

        return view('frontend.rawMaterialTypes.index', compact('rawMaterialTypes'));
    }

    public function create()
    {
        abort_if(Gate::denies('raw_material_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.rawMaterialTypes.create');
    }

    public function store(StoreRawMaterialTypeRequest $request)
    {
        $rawMaterialType = RawMaterialType::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $rawMaterialType->id]);
        }

        return redirect()->route('frontend.raw-material-types.index');
    }

    public function edit(RawMaterialType $rawMaterialType)
    {
        abort_if(Gate::denies('raw_material_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.rawMaterialTypes.edit', compact('rawMaterialType'));
    }

    public function update(UpdateRawMaterialTypeRequest $request, RawMaterialType $rawMaterialType)
    {
        $rawMaterialType->update($request->all());

        return redirect()->route('frontend.raw-material-types.index');
    }

    public function show(RawMaterialType $rawMaterialType)
    {
        abort_if(Gate::denies('raw_material_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.rawMaterialTypes.show', compact('rawMaterialType'));
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
