<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyTvBedConfigRequest;
use App\Http\Requests\StoreTvBedConfigRequest;
use App\Http\Requests\UpdateTvBedConfigRequest;
use App\Models\TvBedConfig;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class TvBedConfigController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('tv_bed_config_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tvBedConfigs = TvBedConfig::all();

        return view('frontend.tvBedConfigs.index', compact('tvBedConfigs'));
    }

    public function create()
    {
        abort_if(Gate::denies('tv_bed_config_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.tvBedConfigs.create');
    }

    public function store(StoreTvBedConfigRequest $request)
    {
        $tvBedConfig = TvBedConfig::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $tvBedConfig->id]);
        }

        return redirect()->route('frontend.tv-bed-configs.index');
    }

    public function edit(TvBedConfig $tvBedConfig)
    {
        abort_if(Gate::denies('tv_bed_config_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.tvBedConfigs.edit', compact('tvBedConfig'));
    }

    public function update(UpdateTvBedConfigRequest $request, TvBedConfig $tvBedConfig)
    {
        $tvBedConfig->update($request->all());

        return redirect()->route('frontend.tv-bed-configs.index');
    }

    public function show(TvBedConfig $tvBedConfig)
    {
        abort_if(Gate::denies('tv_bed_config_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tvBedConfig->load('defaultTvConfigProducts');

        return view('frontend.tvBedConfigs.show', compact('tvBedConfig'));
    }

    public function destroy(TvBedConfig $tvBedConfig)
    {
        abort_if(Gate::denies('tv_bed_config_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tvBedConfig->delete();

        return back();
    }

    public function massDestroy(MassDestroyTvBedConfigRequest $request)
    {
        TvBedConfig::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('tv_bed_config_create') && Gate::denies('tv_bed_config_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new TvBedConfig();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
