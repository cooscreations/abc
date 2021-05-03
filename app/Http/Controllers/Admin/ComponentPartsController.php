<?php

namespace App\Http\Controllers\Admin;

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
use Yajra\DataTables\Facades\DataTables;

class ComponentPartsController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('component_part_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ComponentPart::with(['product_sku', 'component_part_name', 'raw_material', 'primary_suppliers', 'default_product_group'])->select(sprintf('%s.*', (new ComponentPart())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'component_part_show';
                $editGate = 'component_part_edit';
                $deleteGate = 'component_part_delete';
                $crudRoutePart = 'component-parts';

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
            $table->addColumn('product_sku_product_sku', function ($row) {
                return $row->product_sku ? $row->product_sku->product_sku : '';
            });

            $table->addColumn('component_part_name_name', function ($row) {
                return $row->component_part_name ? $row->component_part_name->name : '';
            });

            $table->editColumn('quantity', function ($row) {
                return $row->quantity ? $row->quantity : '';
            });
            $table->editColumn('is_sub_assembly', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->is_sub_assembly ? 'checked' : null) . '>';
            });
            $table->editColumn('is_optional', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->is_optional ? 'checked' : null) . '>';
            });

            $table->rawColumns(['actions', 'placeholder', 'product_sku', 'component_part_name', 'is_sub_assembly', 'is_optional']);

            return $table->make(true);
        }

        return view('admin.componentParts.index');
    }

    public function create()
    {
        abort_if(Gate::denies('component_part_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $product_skus = ProductSku::all()->pluck('product_sku', 'id')->prepend(trans('global.pleaseSelect'), '');

        $component_part_names = ComponentPartName::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $raw_materials = RawMaterial::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $primary_suppliers = ContactCompany::all()->pluck('company_short_code', 'id');

        $default_product_groups = ProductGroup::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.componentParts.create', compact('product_skus', 'component_part_names', 'raw_materials', 'primary_suppliers', 'default_product_groups'));
    }

    public function store(StoreComponentPartRequest $request)
    {
        $componentPart = ComponentPart::create($request->all());
        $componentPart->primary_suppliers()->sync($request->input('primary_suppliers', []));

        return redirect()->route('admin.component-parts.index');
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

        return view('admin.componentParts.edit', compact('product_skus', 'component_part_names', 'raw_materials', 'primary_suppliers', 'default_product_groups', 'componentPart'));
    }

    public function update(UpdateComponentPartRequest $request, ComponentPart $componentPart)
    {
        $componentPart->update($request->all());
        $componentPart->primary_suppliers()->sync($request->input('primary_suppliers', []));

        return redirect()->route('admin.component-parts.index');
    }

    public function show(ComponentPart $componentPart)
    {
        abort_if(Gate::denies('component_part_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $componentPart->load('product_sku', 'component_part_name', 'raw_material', 'primary_suppliers', 'default_product_group');

        return view('admin.componentParts.show', compact('componentPart'));
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
