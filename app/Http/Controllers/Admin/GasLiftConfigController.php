<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyGasLiftConfigRequest;
use App\Http\Requests\StoreGasLiftConfigRequest;
use App\Http\Requests\UpdateGasLiftConfigRequest;
use App\Models\GasLiftConfig;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class GasLiftConfigController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('gas_lift_config_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = GasLiftConfig::query()->select(sprintf('%s.*', (new GasLiftConfig())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'gas_lift_config_show';
                $editGate = 'gas_lift_config_edit';
                $deleteGate = 'gas_lift_config_delete';
                $crudRoutePart = 'gas-lift-configs';

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

        return view('admin.gasLiftConfigs.index');
    }

    public function create()
    {
        abort_if(Gate::denies('gas_lift_config_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.gasLiftConfigs.create');
    }

    public function store(StoreGasLiftConfigRequest $request)
    {
        $gasLiftConfig = GasLiftConfig::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $gasLiftConfig->id]);
        }

        return redirect()->route('admin.gas-lift-configs.index');
    }

    public function edit(GasLiftConfig $gasLiftConfig)
    {
        abort_if(Gate::denies('gas_lift_config_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.gasLiftConfigs.edit', compact('gasLiftConfig'));
    }

    public function update(UpdateGasLiftConfigRequest $request, GasLiftConfig $gasLiftConfig)
    {
        $gasLiftConfig->update($request->all());

        return redirect()->route('admin.gas-lift-configs.index');
    }

    public function show(GasLiftConfig $gasLiftConfig)
    {
        abort_if(Gate::denies('gas_lift_config_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $gasLiftConfig->load('defaultGasLiftConfigProducts');

        return view('admin.gasLiftConfigs.show', compact('gasLiftConfig'));
    }

    public function destroy(GasLiftConfig $gasLiftConfig)
    {
        abort_if(Gate::denies('gas_lift_config_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $gasLiftConfig->delete();

        return back();
    }

    public function massDestroy(MassDestroyGasLiftConfigRequest $request)
    {
        GasLiftConfig::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('gas_lift_config_create') && Gate::denies('gas_lift_config_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new GasLiftConfig();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
