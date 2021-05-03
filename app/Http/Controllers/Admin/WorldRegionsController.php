<?php

namespace App\Http\Controllers\Admin;

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
use Yajra\DataTables\Facades\DataTables;

class WorldRegionsController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('world_region_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = WorldRegion::query()->select(sprintf('%s.*', (new WorldRegion())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'world_region_show';
                $editGate = 'world_region_edit';
                $deleteGate = 'world_region_delete';
                $crudRoutePart = 'world-regions';

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

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.worldRegions.index');
    }

    public function create()
    {
        abort_if(Gate::denies('world_region_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.worldRegions.create');
    }

    public function store(StoreWorldRegionRequest $request)
    {
        $worldRegion = WorldRegion::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $worldRegion->id]);
        }

        return redirect()->route('admin.world-regions.index');
    }

    public function edit(WorldRegion $worldRegion)
    {
        abort_if(Gate::denies('world_region_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.worldRegions.edit', compact('worldRegion'));
    }

    public function update(UpdateWorldRegionRequest $request, WorldRegion $worldRegion)
    {
        $worldRegion->update($request->all());

        return redirect()->route('admin.world-regions.index');
    }

    public function show(WorldRegion $worldRegion)
    {
        abort_if(Gate::denies('world_region_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $worldRegion->load('worldRegionCountries', 'worldRegionBedSizesByRegions');

        return view('admin.worldRegions.show', compact('worldRegion'));
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
