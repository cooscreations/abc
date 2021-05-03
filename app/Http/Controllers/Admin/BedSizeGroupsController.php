<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyBedSizeGroupRequest;
use App\Http\Requests\StoreBedSizeGroupRequest;
use App\Http\Requests\UpdateBedSizeGroupRequest;
use App\Models\BedSizeGroup;
use App\Models\PriceListGroup;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class BedSizeGroupsController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('bed_size_group_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = BedSizeGroup::with(['price_group'])->select(sprintf('%s.*', (new BedSizeGroup())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'bed_size_group_show';
                $editGate = 'bed_size_group_edit';
                $deleteGate = 'bed_size_group_delete';
                $crudRoutePart = 'bed-size-groups';

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
            $table->addColumn('price_group_name', function ($row) {
                return $row->price_group ? $row->price_group->name : '';
            });

            $table->editColumn('price_group.code', function ($row) {
                return $row->price_group ? (is_string($row->price_group) ? $row->price_group : $row->price_group->code) : '';
            });
            $table->editColumn('group_number', function ($row) {
                return $row->group_number ? $row->group_number : '';
            });
            $table->editColumn('is_ukfr', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->is_ukfr ? 'checked' : null) . '>';
            });
            $table->editColumn('mattress_min_w_mm', function ($row) {
                return $row->mattress_min_w_mm ? $row->mattress_min_w_mm : '';
            });
            $table->editColumn('mattress_max_w_mm', function ($row) {
                return $row->mattress_max_w_mm ? $row->mattress_max_w_mm : '';
            });
            $table->editColumn('mattress_min_l_mm', function ($row) {
                return $row->mattress_min_l_mm ? $row->mattress_min_l_mm : '';
            });
            $table->editColumn('mattress_max_l_mm', function ($row) {
                return $row->mattress_max_l_mm ? $row->mattress_max_l_mm : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'price_group', 'is_ukfr']);

            return $table->make(true);
        }

        $price_list_groups = PriceListGroup::get();

        return view('admin.bedSizeGroups.index', compact('price_list_groups'));
    }

    public function create()
    {
        abort_if(Gate::denies('bed_size_group_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $price_groups = PriceListGroup::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.bedSizeGroups.create', compact('price_groups'));
    }

    public function store(StoreBedSizeGroupRequest $request)
    {
        $bedSizeGroup = BedSizeGroup::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $bedSizeGroup->id]);
        }

        return redirect()->route('admin.bed-size-groups.index');
    }

    public function edit(BedSizeGroup $bedSizeGroup)
    {
        abort_if(Gate::denies('bed_size_group_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $price_groups = PriceListGroup::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $bedSizeGroup->load('price_group');

        return view('admin.bedSizeGroups.edit', compact('price_groups', 'bedSizeGroup'));
    }

    public function update(UpdateBedSizeGroupRequest $request, BedSizeGroup $bedSizeGroup)
    {
        $bedSizeGroup->update($request->all());

        return redirect()->route('admin.bed-size-groups.index');
    }

    public function show(BedSizeGroup $bedSizeGroup)
    {
        abort_if(Gate::denies('bed_size_group_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bedSizeGroup->load('price_group', 'relatedSizeGroupsBedSizesByRegions');

        return view('admin.bedSizeGroups.show', compact('bedSizeGroup'));
    }

    public function destroy(BedSizeGroup $bedSizeGroup)
    {
        abort_if(Gate::denies('bed_size_group_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bedSizeGroup->delete();

        return back();
    }

    public function massDestroy(MassDestroyBedSizeGroupRequest $request)
    {
        BedSizeGroup::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('bed_size_group_create') && Gate::denies('bed_size_group_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new BedSizeGroup();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
