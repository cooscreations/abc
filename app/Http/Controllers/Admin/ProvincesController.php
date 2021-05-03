<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyProvinceRequest;
use App\Http\Requests\StoreProvinceRequest;
use App\Http\Requests\UpdateProvinceRequest;
use App\Models\Country;
use App\Models\Province;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ProvincesController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('province_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Province::with(['country'])->select(sprintf('%s.*', (new Province())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'province_show';
                $editGate = 'province_edit';
                $deleteGate = 'province_delete';
                $crudRoutePart = 'provinces';

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
            $table->editColumn('local_name', function ($row) {
                return $row->local_name ? $row->local_name : '';
            });
            $table->addColumn('country_name', function ($row) {
                return $row->country ? $row->country->name : '';
            });

            $table->editColumn('country.alpha_2', function ($row) {
                return $row->country ? (is_string($row->country) ? $row->country : $row->country->alpha_2) : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'country']);

            return $table->make(true);
        }

        return view('admin.provinces.index');
    }

    public function create()
    {
        abort_if(Gate::denies('province_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $countries = Country::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.provinces.create', compact('countries'));
    }

    public function store(StoreProvinceRequest $request)
    {
        $province = Province::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $province->id]);
        }

        return redirect()->route('admin.provinces.index');
    }

    public function edit(Province $province)
    {
        abort_if(Gate::denies('province_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $countries = Country::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $province->load('country');

        return view('admin.provinces.edit', compact('countries', 'province'));
    }

    public function update(UpdateProvinceRequest $request, Province $province)
    {
        $province->update($request->all());

        return redirect()->route('admin.provinces.index');
    }

    public function show(Province $province)
    {
        abort_if(Gate::denies('province_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $province->load('country', 'provinceAddresses');

        return view('admin.provinces.show', compact('province'));
    }

    public function destroy(Province $province)
    {
        abort_if(Gate::denies('province_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $province->delete();

        return back();
    }

    public function massDestroy(MassDestroyProvinceRequest $request)
    {
        Province::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('province_create') && Gate::denies('province_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Province();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
