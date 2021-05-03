<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyDrawerConfigRequest;
use App\Http\Requests\StoreDrawerConfigRequest;
use App\Http\Requests\UpdateDrawerConfigRequest;
use App\Models\DrawerConfig;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class DrawerConfigController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('drawer_config_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $drawerConfigs = DrawerConfig::with(['media'])->get();

        return view('frontend.drawerConfigs.index', compact('drawerConfigs'));
    }

    public function create()
    {
        abort_if(Gate::denies('drawer_config_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.drawerConfigs.create');
    }

    public function store(StoreDrawerConfigRequest $request)
    {
        $drawerConfig = DrawerConfig::create($request->all());

        if ($request->input('photo', false)) {
            $drawerConfig->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $drawerConfig->id]);
        }

        return redirect()->route('frontend.drawer-configs.index');
    }

    public function edit(DrawerConfig $drawerConfig)
    {
        abort_if(Gate::denies('drawer_config_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.drawerConfigs.edit', compact('drawerConfig'));
    }

    public function update(UpdateDrawerConfigRequest $request, DrawerConfig $drawerConfig)
    {
        $drawerConfig->update($request->all());

        if ($request->input('photo', false)) {
            if (!$drawerConfig->photo || $request->input('photo') !== $drawerConfig->photo->file_name) {
                if ($drawerConfig->photo) {
                    $drawerConfig->photo->delete();
                }
                $drawerConfig->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
            }
        } elseif ($drawerConfig->photo) {
            $drawerConfig->photo->delete();
        }

        return redirect()->route('frontend.drawer-configs.index');
    }

    public function show(DrawerConfig $drawerConfig)
    {
        abort_if(Gate::denies('drawer_config_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $drawerConfig->load('defaultDrawerConfigProducts');

        return view('frontend.drawerConfigs.show', compact('drawerConfig'));
    }

    public function destroy(DrawerConfig $drawerConfig)
    {
        abort_if(Gate::denies('drawer_config_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $drawerConfig->delete();

        return back();
    }

    public function massDestroy(MassDestroyDrawerConfigRequest $request)
    {
        DrawerConfig::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('drawer_config_create') && Gate::denies('drawer_config_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new DrawerConfig();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
