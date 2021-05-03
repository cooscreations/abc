<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyProductCodeGroupRequest;
use App\Http\Requests\StoreProductCodeGroupRequest;
use App\Http\Requests\UpdateProductCodeGroupRequest;
use App\Models\ProductCodeGroup;
use App\Models\ProductCollection;
use App\Models\ProductFunction;
use App\Models\ProductType;
use App\Models\StorageOption;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductCodeGroupsController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('product_code_group_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productCodeGroups = ProductCodeGroup::with(['product_collections', 'product_functions', 'product_types', 'storage_options'])->get();

        $product_collections = ProductCollection::get();

        $product_functions = ProductFunction::get();

        $product_types = ProductType::get();

        $storage_options = StorageOption::get();

        return view('frontend.productCodeGroups.index', compact('productCodeGroups', 'product_collections', 'product_functions', 'product_types', 'storage_options'));
    }

    public function create()
    {
        abort_if(Gate::denies('product_code_group_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $product_collections = ProductCollection::all()->pluck('name', 'id');

        $product_functions = ProductFunction::all()->pluck('name', 'id');

        $product_types = ProductType::all()->pluck('name', 'id');

        $storage_options = StorageOption::all()->pluck('name', 'id');

        return view('frontend.productCodeGroups.create', compact('product_collections', 'product_functions', 'product_types', 'storage_options'));
    }

    public function store(StoreProductCodeGroupRequest $request)
    {
        $productCodeGroup = ProductCodeGroup::create($request->all());
        $productCodeGroup->product_collections()->sync($request->input('product_collections', []));
        $productCodeGroup->product_functions()->sync($request->input('product_functions', []));
        $productCodeGroup->product_types()->sync($request->input('product_types', []));
        $productCodeGroup->storage_options()->sync($request->input('storage_options', []));

        return redirect()->route('frontend.product-code-groups.index');
    }

    public function edit(ProductCodeGroup $productCodeGroup)
    {
        abort_if(Gate::denies('product_code_group_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $product_collections = ProductCollection::all()->pluck('name', 'id');

        $product_functions = ProductFunction::all()->pluck('name', 'id');

        $product_types = ProductType::all()->pluck('name', 'id');

        $storage_options = StorageOption::all()->pluck('name', 'id');

        $productCodeGroup->load('product_collections', 'product_functions', 'product_types', 'storage_options');

        return view('frontend.productCodeGroups.edit', compact('product_collections', 'product_functions', 'product_types', 'storage_options', 'productCodeGroup'));
    }

    public function update(UpdateProductCodeGroupRequest $request, ProductCodeGroup $productCodeGroup)
    {
        $productCodeGroup->update($request->all());
        $productCodeGroup->product_collections()->sync($request->input('product_collections', []));
        $productCodeGroup->product_functions()->sync($request->input('product_functions', []));
        $productCodeGroup->product_types()->sync($request->input('product_types', []));
        $productCodeGroup->storage_options()->sync($request->input('storage_options', []));

        return redirect()->route('frontend.product-code-groups.index');
    }

    public function show(ProductCodeGroup $productCodeGroup)
    {
        abort_if(Gate::denies('product_code_group_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productCodeGroup->load('product_collections', 'product_functions', 'product_types', 'storage_options', 'productCodeGroupProducts');

        return view('frontend.productCodeGroups.show', compact('productCodeGroup'));
    }

    public function destroy(ProductCodeGroup $productCodeGroup)
    {
        abort_if(Gate::denies('product_code_group_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productCodeGroup->delete();

        return back();
    }

    public function massDestroy(MassDestroyProductCodeGroupRequest $request)
    {
        ProductCodeGroup::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
