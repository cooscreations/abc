<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyFabricGroupRequest;
use App\Http\Requests\StoreFabricGroupRequest;
use App\Http\Requests\UpdateFabricGroupRequest;
use App\Models\ContactCompany;
use App\Models\FabricGroup;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class FabricGroupsController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('fabric_group_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fabricGroups = FabricGroup::with(['primary_supplier'])->get();

        return view('frontend.fabricGroups.index', compact('fabricGroups'));
    }

    public function create()
    {
        abort_if(Gate::denies('fabric_group_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $primary_suppliers = ContactCompany::all()->pluck('company_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.fabricGroups.create', compact('primary_suppliers'));
    }

    public function store(StoreFabricGroupRequest $request)
    {
        $fabricGroup = FabricGroup::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $fabricGroup->id]);
        }

        return redirect()->route('frontend.fabric-groups.index');
    }

    public function edit(FabricGroup $fabricGroup)
    {
        abort_if(Gate::denies('fabric_group_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $primary_suppliers = ContactCompany::all()->pluck('company_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $fabricGroup->load('primary_supplier');

        return view('frontend.fabricGroups.edit', compact('primary_suppliers', 'fabricGroup'));
    }

    public function update(UpdateFabricGroupRequest $request, FabricGroup $fabricGroup)
    {
        $fabricGroup->update($request->all());

        return redirect()->route('frontend.fabric-groups.index');
    }

    public function show(FabricGroup $fabricGroup)
    {
        abort_if(Gate::denies('fabric_group_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fabricGroup->load('primary_supplier', 'fabricGroupFabrics');

        return view('frontend.fabricGroups.show', compact('fabricGroup'));
    }

    public function destroy(FabricGroup $fabricGroup)
    {
        abort_if(Gate::denies('fabric_group_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fabricGroup->delete();

        return back();
    }

    public function massDestroy(MassDestroyFabricGroupRequest $request)
    {
        FabricGroup::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('fabric_group_create') && Gate::denies('fabric_group_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new FabricGroup();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
