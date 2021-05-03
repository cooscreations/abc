<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyVisitorBedConfigRequest;
use App\Http\Requests\StoreVisitorBedConfigRequest;
use App\Http\Requests\UpdateVisitorBedConfigRequest;
use App\Models\VisitorBedConfig;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class VisitorBedConfigController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('visitor_bed_config_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $visitorBedConfigs = VisitorBedConfig::all();

        return view('frontend.visitorBedConfigs.index', compact('visitorBedConfigs'));
    }

    public function create()
    {
        abort_if(Gate::denies('visitor_bed_config_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.visitorBedConfigs.create');
    }

    public function store(StoreVisitorBedConfigRequest $request)
    {
        $visitorBedConfig = VisitorBedConfig::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $visitorBedConfig->id]);
        }

        return redirect()->route('frontend.visitor-bed-configs.index');
    }

    public function edit(VisitorBedConfig $visitorBedConfig)
    {
        abort_if(Gate::denies('visitor_bed_config_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.visitorBedConfigs.edit', compact('visitorBedConfig'));
    }

    public function update(UpdateVisitorBedConfigRequest $request, VisitorBedConfig $visitorBedConfig)
    {
        $visitorBedConfig->update($request->all());

        return redirect()->route('frontend.visitor-bed-configs.index');
    }

    public function show(VisitorBedConfig $visitorBedConfig)
    {
        abort_if(Gate::denies('visitor_bed_config_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $visitorBedConfig->load('defaultVisitorConfigProducts');

        return view('frontend.visitorBedConfigs.show', compact('visitorBedConfig'));
    }

    public function destroy(VisitorBedConfig $visitorBedConfig)
    {
        abort_if(Gate::denies('visitor_bed_config_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $visitorBedConfig->delete();

        return back();
    }

    public function massDestroy(MassDestroyVisitorBedConfigRequest $request)
    {
        VisitorBedConfig::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('visitor_bed_config_create') && Gate::denies('visitor_bed_config_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new VisitorBedConfig();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
