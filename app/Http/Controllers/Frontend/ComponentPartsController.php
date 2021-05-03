<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyComponentPartRequest;
use App\Http\Requests\StoreComponentPartRequest;
use App\Http\Requests\UpdateComponentPartRequest;
use App\Models\ComponentPart;
use App\Models\ComponentPartName;
use App\Models\ContactCompany;
use App\Models\ProductGroup;
use App\Models\ProductSku;
use App\Models\RawMaterial;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ComponentPartsController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('component_part_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $componentParts = ComponentPart::with(['product_sku', 'component_part_name', 'raw_material', 'primary_suppliers', 'default_product_group'])->get();

        return view('frontend.componentParts.index', compact('componentParts'));
    }

    public function create()
    {
        abort_if(Gate::denies('component_part_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $product_skus = ProductSku::all()->pluck('product_sku', 'id')->prepend(trans('global.pleaseSelect'), '');

        $component_part_names = ComponentPartName::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $raw_materials = RawMaterial::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $primary_suppliers = ContactCompany::all()->pluck('company_short_code', 'id');

        $default_product_groups = ProductGroup::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.componentParts.create', compact('product_skus', 'component_part_names', 'raw_materials', 'primary_suppliers', 'default_product_groups'));
    }

    public function store(StoreComponentPartRequest $request)
    {
        $componentPart = ComponentPart::create($request->all());
        $componentPart->primary_suppliers()->sync($request->input('primary_suppliers', []));

        return redirect()->route('frontend.component-parts.index');
    }

    public function edit(ComponentPart $componentPart)
    {
        abort_if(Gate::denies('component_part_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $product_skus = ProductSku::all()->pluck('product_sku', 'id')->prepend(trans('global.pleaseSelect'), '');

        $component_part_names = ComponentPartName::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $raw_materials = RawMaterial::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $primary_suppliers = ContactCompany::all()->pluck('company_short_code', 'id');

        $default_product_groups = ProductGroup::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $componentPart->load('product_sku', 'component_part_name', 'raw_material', 'primary_suppliers', 'default_product_group');

        return view('frontend.componentParts.edit', compact('product_skus', 'component_part_names', 'raw_materials', 'primary_suppliers', 'default_product_groups', 'componentPart'));
    }

    public function update(UpdateComponentPartRequest $request, ComponentPart $componentPart)
    {
        $componentPart->update($request->all());
        $componentPart->primary_suppliers()->sync($request->input('primary_suppliers', []));

        return redirect()->route('frontend.component-parts.index');
    }

    public function show(ComponentPart $componentPart)
    {
        abort_if(Gate::denies('component_part_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $componentPart->load('product_sku', 'component_part_name', 'raw_material', 'primary_suppliers', 'default_product_group');

        return view('frontend.componentParts.show', compact('componentPart'));
    }

    public function destroy(ComponentPart $componentPart)
    {
        abort_if(Gate::denies('component_part_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $componentPart->delete();

        return back();
    }

    public function massDestroy(MassDestroyComponentPartRequest $request)
    {
        ComponentPart::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
