<?php

namespace App\Http\Controllers\Admin;

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
use Yajra\DataTables\Facades\DataTables;

class TvBedConfigController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('tv_bed_config_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = TvBedConfig::query()->select(sprintf('%s.*', (new TvBedConfig())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'tv_bed_config_show';
                $editGate = 'tv_bed_config_edit';
                $deleteGate = 'tv_bed_config_delete';
                $crudRoutePart = 'tv-bed-configs';

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

        return view('admin.tvBedConfigs.index');
    }

    public function create()
    {
        abort_if(Gate::denies('tv_bed_config_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.tvBedConfigs.create');
    }

    public function store(StoreTvBedConfigRequest $request)
    {
        $tvBedConfig = TvBedConfig::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $tvBedConfig->id]);
        }

        return redirect()->route('admin.tv-bed-configs.index');
    }

    public function edit(TvBedConfig $tvBedConfig)
    {
        abort_if(Gate::denies('tv_bed_config_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.tvBedConfigs.edit', compact('tvBedConfig'));
    }

    public function update(UpdateTvBedConfigRequest $request, TvBedConfig $tvBedConfig)
    {
        $tvBedConfig->update($request->all());

        return redirect()->route('admin.tv-bed-configs.index');
    }

    public function show(TvBedConfig $tvBedConfig)
    {
        abort_if(Gate::denies('tv_bed_config_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tvBedConfig->load('defaultTvConfigProducts');

        return view('admin.tvBedConfigs.show', compact('tvBedConfig'));
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
