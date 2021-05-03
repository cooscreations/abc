<?php

namespace App\Http\Controllers\Admin;

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
use Yajra\DataTables\Facades\DataTables;

class BedSizesByRegionController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('bed_sizes_by_region_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = BedSizesByRegion::with(['world_region', 'size_name', 'base_style', 'related_size_groups'])->select(sprintf('%s.*', (new BedSizesByRegion())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'bed_sizes_by_region_show';
                $editGate = 'bed_sizes_by_region_edit';
                $deleteGate = 'bed_sizes_by_region_delete';
                $crudRoutePart = 'bed-sizes-by-regions';

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
            $table->editColumn('size_code', function ($row) {
                return $row->size_code ? $row->size_code : '';
            });
            $table->addColumn('world_region_name', function ($row) {
                return $row->world_region ? $row->world_region->name : '';
            });

            $table->addColumn('size_name_name', function ($row) {
                return $row->size_name ? $row->size_name->name : '';
            });

            $table->editColumn('mattress_w_mm', function ($row) {
                return $row->mattress_w_mm ? $row->mattress_w_mm : '';
            });
            $table->editColumn('mattress_l_mm', function ($row) {
                return $row->mattress_l_mm ? $row->mattress_l_mm : '';
            });
            $table->editColumn('imperial_nickname', function ($row) {
                return $row->imperial_nickname ? $row->imperial_nickname : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'world_region', 'size_name']);

            return $table->make(true);
        }

        return view('admin.bedSizesByRegions.index');
    }

    public function create()
    {
        abort_if(Gate::denies('bed_sizes_by_region_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $world_regions = WorldRegion::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $size_names = ProductSizeName::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $base_styles = BaseStyle::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $related_size_groups = BedSizeGroup::all()->pluck('name', 'id');

        return view('admin.bedSizesByRegions.create', compact('world_regions', 'size_names', 'base_styles', 'related_size_groups'));
    }

    public function store(StoreBedSizesByRegionRequest $request)
    {
        $bedSizesByRegion = BedSizesByRegion::create($request->all());
        $bedSizesByRegion->related_size_groups()->sync($request->input('related_size_groups', []));

        return redirect()->route('admin.bed-sizes-by-regions.index');
    }

    public function edit(BedSizesByRegion $bedSizesByRegion)
    {
        abort_if(Gate::denies('bed_sizes_by_region_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $world_regions = WorldRegion::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $size_names = ProductSizeName::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $base_styles = BaseStyle::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $related_size_groups = BedSizeGroup::all()->pluck('name', 'id');

        $bedSizesByRegion->load('world_region', 'size_name', 'base_style', 'related_size_groups');

        return view('admin.bedSizesByRegions.edit', compact('world_regions', 'size_names', 'base_styles', 'related_size_groups', 'bedSizesByRegion'));
    }

    public function update(UpdateBedSizesByRegionRequest $request, BedSizesByRegion $bedSizesByRegion)
    {
        $bedSizesByRegion->update($request->all());
        $bedSizesByRegion->related_size_groups()->sync($request->input('related_size_groups', []));

        return redirect()->route('admin.bed-sizes-by-regions.index');
    }

    public function show(BedSizesByRegion $bedSizesByRegion)
    {
        abort_if(Gate::denies('bed_sizes_by_region_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bedSizesByRegion->load('world_region', 'size_name', 'base_style', 'related_size_groups', 'sizeProductSkus');

        return view('admin.bedSizesByRegions.show', compact('bedSizesByRegion'));
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
