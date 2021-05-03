<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyFabricPriceBandRequest;
use App\Http\Requests\StoreFabricPriceBandRequest;
use App\Http\Requests\UpdateFabricPriceBandRequest;
use App\Models\FabricPriceBand;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class FabricPriceBandsController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('fabric_price_band_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = FabricPriceBand::query()->select(sprintf('%s.*', (new FabricPriceBand())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'fabric_price_band_show';
                $editGate = 'fabric_price_band_edit';
                $deleteGate = 'fabric_price_band_delete';
                $crudRoutePart = 'fabric-price-bands';

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
            $table->editColumn('band_letter', function ($row) {
                return $row->band_letter ? $row->band_letter : '';
            });
            $table->editColumn('cny_start_price', function ($row) {
                return $row->cny_start_price ? $row->cny_start_price : '';
            });
            $table->editColumn('cny_finish_price', function ($row) {
                return $row->cny_finish_price ? $row->cny_finish_price : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.fabricPriceBands.index');
    }

    public function create()
    {
        abort_if(Gate::denies('fabric_price_band_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.fabricPriceBands.create');
    }

    public function store(StoreFabricPriceBandRequest $request)
    {
        $fabricPriceBand = FabricPriceBand::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $fabricPriceBand->id]);
        }

        return redirect()->route('admin.fabric-price-bands.index');
    }

    public function edit(FabricPriceBand $fabricPriceBand)
    {
        abort_if(Gate::denies('fabric_price_band_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.fabricPriceBands.edit', compact('fabricPriceBand'));
    }

    public function update(UpdateFabricPriceBandRequest $request, FabricPriceBand $fabricPriceBand)
    {
        $fabricPriceBand->update($request->all());

        return redirect()->route('admin.fabric-price-bands.index');
    }

    public function show(FabricPriceBand $fabricPriceBand)
    {
        abort_if(Gate::denies('fabric_price_band_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.fabricPriceBands.show', compact('fabricPriceBand'));
    }

    public function destroy(FabricPriceBand $fabricPriceBand)
    {
        abort_if(Gate::denies('fabric_price_band_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fabricPriceBand->delete();

        return back();
    }

    public function massDestroy(MassDestroyFabricPriceBandRequest $request)
    {
        FabricPriceBand::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('fabric_price_band_create') && Gate::denies('fabric_price_band_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new FabricPriceBand();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
