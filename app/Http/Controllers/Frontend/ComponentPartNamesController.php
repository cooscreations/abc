<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyComponentPartNameRequest;
use App\Http\Requests\StoreComponentPartNameRequest;
use App\Http\Requests\UpdateComponentPartNameRequest;
use App\Models\ComponentPartName;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class ComponentPartNamesController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('component_part_name_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $componentPartNames = ComponentPartName::with(['media'])->get();

        return view('frontend.componentPartNames.index', compact('componentPartNames'));
    }

    public function create()
    {
        abort_if(Gate::denies('component_part_name_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.componentPartNames.create');
    }

    public function store(StoreComponentPartNameRequest $request)
    {
        $componentPartName = ComponentPartName::create($request->all());

        foreach ($request->input('photo', []) as $file) {
            $componentPartName->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $componentPartName->id]);
        }

        return redirect()->route('frontend.component-part-names.index');
    }

    public function edit(ComponentPartName $componentPartName)
    {
        abort_if(Gate::denies('component_part_name_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.componentPartNames.edit', compact('componentPartName'));
    }

    public function update(UpdateComponentPartNameRequest $request, ComponentPartName $componentPartName)
    {
        $componentPartName->update($request->all());

        if (count($componentPartName->photo) > 0) {
            foreach ($componentPartName->photo as $media) {
                if (!in_array($media->file_name, $request->input('photo', []))) {
                    $media->delete();
                }
            }
        }
        $media = $componentPartName->photo->pluck('file_name')->toArray();
        foreach ($request->input('photo', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $componentPartName->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('photo');
            }
        }

        return redirect()->route('frontend.component-part-names.index');
    }

    public function show(ComponentPartName $componentPartName)
    {
        abort_if(Gate::denies('component_part_name_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $componentPartName->load('componentPartNameComponentParts');

        return view('frontend.componentPartNames.show', compact('componentPartName'));
    }

    public function destroy(ComponentPartName $componentPartName)
    {
        abort_if(Gate::denies('component_part_name_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $componentPartName->delete();

        return back();
    }

    public function massDestroy(MassDestroyComponentPartNameRequest $request)
    {
        ComponentPartName::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('component_part_name_create') && Gate::denies('component_part_name_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new ComponentPartName();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
