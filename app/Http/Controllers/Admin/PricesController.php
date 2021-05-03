<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyPriceRequest;
use App\Http\Requests\StorePriceRequest;
use App\Http\Requests\UpdatePriceRequest;
use App\Models\Price;
use App\Models\PriceList;
use App\Models\ProductSku;
use App\Models\RawMaterial;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PricesController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('price_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Price::with(['sku', 'default_raw_material', 'price_list'])->select(sprintf('%s.*', (new Price())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'price_show';
                $editGate = 'price_edit';
                $deleteGate = 'price_delete';
                $crudRoutePart = 'prices';

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
            $table->addColumn('sku_product_sku', function ($row) {
                return $row->sku ? $row->sku->product_sku : '';
            });

            $table->addColumn('default_raw_material_name', function ($row) {
                return $row->default_raw_material ? $row->default_raw_material->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'sku', 'default_raw_material']);

            return $table->make(true);
        }

        $product_skus  = ProductSku::get();
        $raw_materials = RawMaterial::get();
        $price_lists   = PriceList::get();

        return view('admin.prices.index', compact('product_skus', 'raw_materials', 'price_lists'));
    }

    public function create()
    {
        abort_if(Gate::denies('price_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $skus = ProductSku::all()->pluck('product_sku', 'id')->prepend(trans('global.pleaseSelect'), '');

        $default_raw_materials = RawMaterial::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $price_lists = PriceList::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.prices.create', compact('skus', 'default_raw_materials', 'price_lists'));
    }

    public function store(StorePriceRequest $request)
    {
        $price = Price::create($request->all());

        return redirect()->route('admin.prices.index');
    }

    public function edit(Price $price)
    {
        abort_if(Gate::denies('price_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $skus = ProductSku::all()->pluck('product_sku', 'id')->prepend(trans('global.pleaseSelect'), '');

        $default_raw_materials = RawMaterial::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $price_lists = PriceList::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $price->load('sku', 'default_raw_material', 'price_list');

        return view('admin.prices.edit', compact('skus', 'default_raw_materials', 'price_lists', 'price'));
    }

    public function update(UpdatePriceRequest $request, Price $price)
    {
        $price->update($request->all());

        return redirect()->route('admin.prices.index');
    }

    public function show(Price $price)
    {
        abort_if(Gate::denies('price_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $price->load('sku', 'default_raw_material', 'price_list');

        return view('admin.prices.show', compact('price'));
    }

    public function destroy(Price $price)
    {
        abort_if(Gate::denies('price_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $price->delete();

        return back();
    }

    public function massDestroy(MassDestroyPriceRequest $request)
    {
        Price::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
