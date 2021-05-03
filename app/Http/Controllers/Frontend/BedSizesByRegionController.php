<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyBedSizesByRegionRequest;
use App\Http\Requests\StoreBedSizesByRegionRequest;
use App\Http\Requests\UpdateBedSizesByRegionRequest;
use App\Models\BaseStyle;
use App\Models\BedSizeGroup;
use App\Models\BedSizesByRegion;
use App\Models\ProductSizeName;
use App\Models\WorldRegion;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BedSizesByRegionController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('bed_sizes_by_region_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bedSizesByRegions = BedSizesByRegion::with(['world_region', 'size_name', 'base_style', 'related_size_groups'])->get();

        return view('frontend.bedSizesByRegions.index', compact('bedSizesByRegions'));
    }

    public function create()
    {
        abort_if(Gate::denies('bed_sizes_by_region_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $world_regions = WorldRegion::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $size_names = ProductSizeName::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $base_styles = BaseStyle::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $related_size_groups = BedSizeGroup::all()->pluck('name', 'id');

        return view('frontend.bedSizesByRegions.create', compact('world_regions', 'size_names', 'base_styles', 'related_size_groups'));
    }

    public function store(StoreBedSizesByRegionRequest $request)
    {
        $bedSizesByRegion = BedSizesByRegion::create($request->all());
        $bedSizesByRegion->related_size_groups()->sync($request->input('related_size_groups', []));

        return redirect()->route('frontend.bed-sizes-by-regions.index');
    }

    public function edit(BedSizesByRegion $bedSizesByRegion)
    {
        abort_if(Gate::denies('bed_sizes_by_region_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $world_regions = WorldRegion::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $size_names = ProductSizeName::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $base_styles = BaseStyle::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $related_size_groups = BedSizeGroup::all()->pluck('name', 'id');

        $bedSizesByRegion->load('world_region', 'size_name', 'base_style', 'related_size_groups');

        return view('frontend.bedSizesByRegions.edit', compact('world_regions', 'size_names', 'base_styles', 'related_size_groups', 'bedSizesByRegion'));
    }

    public function update(UpdateBedSizesByRegionRequest $request, BedSizesByRegion $bedSizesByRegion)
    {
        $bedSizesByRegion->update($request->all());
        $bedSizesByRegion->related_size_groups()->sync($request->input('related_size_groups', []));

        return redirect()->route('frontend.bed-sizes-by-regions.index');
    }

    public function show(BedSizesByRegion $bedSizesByRegion)
    {
        abort_if(Gate::denies('bed_sizes_by_region_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bedSizesByRegion->load('world_region', 'size_name', 'base_style', 'related_size_groups', 'sizeProductSkus');

        return view('frontend.bedSizesByRegions.show', compact('bedSizesByRegion'));
    }

    public function destroy(BedSizesByRegion $bedSizesByRegion)
    {
        abort_if(Gate::denies('bed_sizes_by_region_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bedSizesByRegion->delete();

        return back();
    }

    public function massDestroy(MassDestroyBedSizesByRegionRequest $request)
    {
        BedSizesByRegion::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
