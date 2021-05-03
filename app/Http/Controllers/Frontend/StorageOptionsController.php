<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyStorageOptionRequest;
use App\Http\Requests\StoreStorageOptionRequest;
use App\Http\Requests\UpdateStorageOptionRequest;
use App\Models\StorageOption;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class StorageOptionsController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('storage_option_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $storageOptions = StorageOption::all();

        return view('frontend.storageOptions.index', compact('storageOptions'));
    }

    public function create()
    {
        abort_if(Gate::denies('storage_option_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.storageOptions.create');
    }

    public function store(StoreStorageOptionRequest $request)
    {
        $storageOption = StorageOption::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $storageOption->id]);
        }

        return redirect()->route('frontend.storage-options.index');
    }

    public function edit(StorageOption $storageOption)
    {
        abort_if(Gate::denies('storage_option_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.storageOptions.edit', compact('storageOption'));
    }

    public function update(UpdateStorageOptionRequest $request, StorageOption $storageOption)
    {
        $storageOption->update($request->all());

        return redirect()->route('frontend.storage-options.index');
    }

    public function show(StorageOption $storageOption)
    {
        abort_if(Gate::denies('storage_option_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $storageOption->load('defaultStorageProducts', 'storageOptionsProductCodeGroups');

        return view('frontend.storageOptions.show', compact('storageOption'));
    }

    public function destroy(StorageOption $storageOption)
    {
        abort_if(Gate::denies('storage_option_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $storageOption->delete();

        return back();
    }

    public function massDestroy(MassDestroyStorageOptionRequest $request)
    {
        StorageOption::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('storage_option_create') && Gate::denies('storage_option_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new StorageOption();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
