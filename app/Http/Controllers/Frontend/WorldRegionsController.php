<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyWorldRegionRequest;
use App\Http\Requests\StoreWorldRegionRequest;
use App\Http\Requests\UpdateWorldRegionRequest;
use App\Models\WorldRegion;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class WorldRegionsController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('world_region_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $worldRegions = WorldRegion::all();

        return view('frontend.worldRegions.index', compact('worldRegions'));
    }

    public function create()
    {
        abort_if(Gate::denies('world_region_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.worldRegions.create');
    }

    public function store(StoreWorldRegionRequest $request)
    {
        $worldRegion = WorldRegion::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $worldRegion->id]);
        }

        return redirect()->route('frontend.world-regions.index');
    }

    public function edit(WorldRegion $worldRegion)
    {
        abort_if(Gate::denies('world_region_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.worldRegions.edit', compact('worldRegion'));
    }

    public function update(UpdateWorldRegionRequest $request, WorldRegion $worldRegion)
    {
        $worldRegion->update($request->all());

        return redirect()->route('frontend.world-regions.index');
    }

    public function show(WorldRegion $worldRegion)
    {
        abort_if(Gate::denies('world_region_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $worldRegion->load('worldRegionCountries', 'worldRegionBedSizesByRegions');

        return view('frontend.worldRegions.show', compact('worldRegion'));
    }

    public function destroy(WorldRegion $worldRegion)
    {
        abort_if(Gate::denies('world_region_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $worldRegion->delete();

        return back();
    }

    public function massDestroy(MassDestroyWorldRegionRequest $request)
    {
        WorldRegion::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('world_region_create') && Gate::denies('world_region_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new WorldRegion();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
