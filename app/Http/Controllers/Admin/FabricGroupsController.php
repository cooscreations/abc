<?php

namespace App\Http\Controllers\Admin;

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
use Yajra\DataTables\Facades\DataTables;

class FabricGroupsController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('fabric_group_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = FabricGroup::with(['primary_supplier'])->select(sprintf('%s.*', (new FabricGroup())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'fabric_group_show';
                $editGate = 'fabric_group_edit';
                $deleteGate = 'fabric_group_delete';
                $crudRoutePart = 'fabric-groups';

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
            $table->editColumn('afa_fabric_group_code', function ($row) {
                return $row->afa_fabric_group_code ? $row->afa_fabric_group_code : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.fabricGroups.index');
    }

    public function create()
    {
        abort_if(Gate::denies('fabric_group_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $primary_suppliers = ContactCompany::all()->pluck('company_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.fabricGroups.create', compact('primary_suppliers'));
    }

    public function store(StoreFabricGroupRequest $request)
    {
        $fabricGroup = FabricGroup::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $fabricGroup->id]);
        }

        return redirect()->route('admin.fabric-groups.index');
    }

    public function edit(FabricGroup $fabricGroup)
    {
        abort_if(Gate::denies('fabric_group_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $primary_suppliers = ContactCompany::all()->pluck('company_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $fabricGroup->load('primary_supplier');

        return view('admin.fabricGroups.edit', compact('primary_suppliers', 'fabricGroup'));
    }

    public function update(UpdateFabricGroupRequest $request, FabricGroup $fabricGroup)
    {
        $fabricGroup->update($request->all());

        return redirect()->route('admin.fabric-groups.index');
    }

    public function show(FabricGroup $fabricGroup)
    {
        abort_if(Gate::denies('fabric_group_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fabricGroup->load('primary_supplier', 'fabricGroupFabrics');

        return view('admin.fabricGroups.show', compact('fabricGroup'));
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
