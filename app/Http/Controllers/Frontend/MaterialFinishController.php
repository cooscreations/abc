<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyMaterialFinishRequest;
use App\Http\Requests\StoreMaterialFinishRequest;
use App\Http\Requests\UpdateMaterialFinishRequest;
use App\Models\MaterialFinish;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class MaterialFinishController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('material_finish_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $materialFinishes = MaterialFinish::with(['media'])->get();

        return view('frontend.materialFinishes.index', compact('materialFinishes'));
    }

    public function create()
    {
        abort_if(Gate::denies('material_finish_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.materialFinishes.create');
    }

    public function store(StoreMaterialFinishRequest $request)
    {
        $materialFinish = MaterialFinish::create($request->all());

        foreach ($request->input('photos', []) as $file) {
            $materialFinish->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('photos');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $materialFinish->id]);
        }

        return redirect()->route('frontend.material-finishes.index');
    }

    public function edit(MaterialFinish $materialFinish)
    {
        abort_if(Gate::denies('material_finish_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.materialFinishes.edit', compact('materialFinish'));
    }

    public function update(UpdateMaterialFinishRequest $request, MaterialFinish $materialFinish)
    {
        $materialFinish->update($request->all());

        if (count($materialFinish->photos) > 0) {
            foreach ($materialFinish->photos as $media) {
                if (!in_array($media->file_name, $request->input('photos', []))) {
                    $media->delete();
                }
            }
        }
        $media = $materialFinish->photos->pluck('file_name')->toArray();
        foreach ($request->input('photos', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $materialFinish->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('photos');
            }
        }

        return redirect()->route('frontend.material-finishes.index');
    }

    public function show(MaterialFinish $materialFinish)
    {
        abort_if(Gate::denies('material_finish_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $materialFinish->load('stdMaterialFinishRawMaterials');

        return view('frontend.materialFinishes.show', compact('materialFinish'));
    }

    public function destroy(MaterialFinish $materialFinish)
    {
        abort_if(Gate::denies('material_finish_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $materialFinish->delete();

        return back();
    }

    public function massDestroy(MassDestroyMaterialFinishRequest $request)
    {
        MaterialFinish::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('material_finish_create') && Gate::denies('material_finish_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new MaterialFinish();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
