<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyProductGroupRequest;
use App\Http\Requests\StoreProductGroupRequest;
use App\Http\Requests\UpdateProductGroupRequest;
use App\Models\ProductGroup;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class ProductGroupsController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('product_group_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productGroups = ProductGroup::with(['media'])->get();

        return view('frontend.productGroups.index', compact('productGroups'));
    }

    public function create()
    {
        abort_if(Gate::denies('product_group_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.productGroups.create');
    }

    public function store(StoreProductGroupRequest $request)
    {
        $productGroup = ProductGroup::create($request->all());

        if ($request->input('logo', false)) {
            $productGroup->addMedia(storage_path('tmp/uploads/' . basename($request->input('logo'))))->toMediaCollection('logo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $productGroup->id]);
        }

        return redirect()->route('frontend.product-groups.index');
    }

    public function edit(ProductGroup $productGroup)
    {
        abort_if(Gate::denies('product_group_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.productGroups.edit', compact('productGroup'));
    }

    public function update(UpdateProductGroupRequest $request, ProductGroup $productGroup)
    {
        $productGroup->update($request->all());

        if ($request->input('logo', false)) {
            if (!$productGroup->logo || $request->input('logo') !== $productGroup->logo->file_name) {
                if ($productGroup->logo) {
                    $productGroup->logo->delete();
                }
                $productGroup->addMedia(storage_path('tmp/uploads/' . basename($request->input('logo'))))->toMediaCollection('logo');
            }
        } elseif ($productGroup->logo) {
            $productGroup->logo->delete();
        }

        return redirect()->route('frontend.product-groups.index');
    }

    public function show(ProductGroup $productGroup)
    {
        abort_if(Gate::denies('product_group_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productGroup->load('defaultGroupProducts', 'defaultProductGroupComponentParts');

        return view('frontend.productGroups.show', compact('productGroup'));
    }

    public function destroy(ProductGroup $productGroup)
    {
        abort_if(Gate::denies('product_group_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productGroup->delete();

        return back();
    }

    public function massDestroy(MassDestroyProductGroupRequest $request)
    {
        ProductGroup::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('product_group_create') && Gate::denies('product_group_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new ProductGroup();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
