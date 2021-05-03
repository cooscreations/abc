<?php

namespace App\Http\Controllers\Frontend;

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

class BedSizeGroupsController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('bed_size_group_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bedSizeGroups = BedSizeGroup::with(['price_group'])->get();

        $price_list_groups = PriceListGroup::get();

        return view('frontend.bedSizeGroups.index', compact('bedSizeGroups', 'price_list_groups'));
    }

    public function create()
    {
        abort_if(Gate::denies('bed_size_group_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $price_groups = PriceListGroup::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.bedSizeGroups.create', compact('price_groups'));
    }

    public function store(StoreBedSizeGroupRequest $request)
    {
        $bedSizeGroup = BedSizeGroup::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $bedSizeGroup->id]);
        }

        return redirect()->route('frontend.bed-size-groups.index');
    }

    public function edit(BedSizeGroup $bedSizeGroup)
    {
        abort_if(Gate::denies('bed_size_group_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $price_groups = PriceListGroup::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $bedSizeGroup->load('price_group');

        return view('frontend.bedSizeGroups.edit', compact('price_groups', 'bedSizeGroup'));
    }

    public function update(UpdateBedSizeGroupRequest $request, BedSizeGroup $bedSizeGroup)
    {
        $bedSizeGroup->update($request->all());

        return redirect()->route('frontend.bed-size-groups.index');
    }

    public function show(BedSizeGroup $bedSizeGroup)
    {
        abort_if(Gate::denies('bed_size_group_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bedSizeGroup->load('price_group', 'relatedSizeGroupsBedSizesByRegions');

        return view('frontend.bedSizeGroups.show', compact('bedSizeGroup'));
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
