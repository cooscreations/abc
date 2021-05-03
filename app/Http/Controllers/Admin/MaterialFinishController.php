<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyMaterialFinishRequest;
use App\Http\Requests\StoreMaterialFinishRequest;
use App\Http\Requests\UpdateMaterialFinishRequest;
use App\Models\MaterialFinish;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class MaterialFinishController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('material_finish_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = MaterialFinish::query()->select(sprintf('%s.*', (new MaterialFinish())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'material_finish_show';
                $editGate = 'material_finish_edit';
                $deleteGate = 'material_finish_delete';
                $crudRoutePart = 'material-finishes';

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
            $table->editColumn('photos', function ($row) {
                if (!$row->photos) {
                    return '';
                }
                $links = [];
                foreach ($row->photos as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank"><img src="' . $media->getUrl('thumb') . '" width="50px" height="50px"></a>';
                }

                return implode(' ', $links);
            });

            $table->rawColumns(['actions', 'placeholder', 'photos']);

            return $table->make(true);
        }

        return view('admin.materialFinishes.index');
    }

    public function create()
    {
        abort_if(Gate::denies('material_finish_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.materialFinishes.create');
    }

    public function store(StoreMaterialFinishRequest $request)
    {
        $materialFinish = MaterialFinish::create($request->all());

        foreach ($request->input('photos', []) as $file) {
            $materialFinish->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('photos');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $materialFinish->id]);
        }

        return redirect()->route('admin.material-finishes.index');
    }

    public function edit(MaterialFinish $materialFinish)
    {
        abort_if(Gate::denies('material_finish_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.materialFinishes.edit', compact('materialFinish'));
    }

    public function update(UpdateMaterialFinishRequest $request, MaterialFinish $materialFinish)
    {
        $materialFinish->update($request->all());

        if (count($materialFinish->photos) > 0) {
            foreach ($materialFinish->photos as $media) {
                if (!in_array($media->file_name, $request->input('photos', []))) {
                    $media->delete();
                }
            }
        }
        $media = $materialFinish->photos->pluck('file_name')->toArray();
        foreach ($request->input('photos', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $materialFinish->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('photos');
            }
        }

        return redirect()->route('admin.material-finishes.index');
    }

    public function show(MaterialFinish $materialFinish)
    {
        abort_if(Gate::denies('material_finish_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $materialFinish->load('stdMaterialFinishRawMaterials');

        return view('admin.materialFinishes.show', compact('materialFinish'));
    }

    public function destroy(MaterialFinish $materialFinish)
    {
        abort_if(Gate::denies('material_finish_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $materialFinish->delete();

        return back();
    }

    public function massDestroy(MassDestroyMaterialFinishRequest $request)
    {
        MaterialFinish::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('material_finish_create') && Gate::denies('material_finish_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new MaterialFinish();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
