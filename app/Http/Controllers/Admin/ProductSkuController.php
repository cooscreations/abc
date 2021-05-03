<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyProductSkuRequest;
use App\Http\Requests\StoreProductSkuRequest;
use App\Http\Requests\UpdateProductSkuRequest;
use App\Models\BedSizesByRegion;
use App\Models\Product;
use App\Models\ProductDevelopmentStage;
use App\Models\ProductSku;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ProductSkuController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('product_sku_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ProductSku::with(['product', 'prod_dev_stage', 'size'])->select(sprintf('%s.*', (new ProductSku())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'product_sku_show';
                $editGate = 'product_sku_edit';
                $deleteGate = 'product_sku_delete';
                $crudRoutePart = 'product-skus';

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
            $table->editColumn('product_sku', function ($row) {
                return $row->product_sku ? $row->product_sku : '';
            });
            $table->addColumn('size_name', function ($row) {
                return $row->size ? $row->size->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'size']);

            return $table->make(true);
        }

        $products                   = Product::get();
        $product_development_stages = ProductDevelopmentStage::get();
        $bed_sizes_by_regions       = BedSizesByRegion::get();

        return view('admin.productSkus.index', compact('products', 'product_development_stages', 'bed_sizes_by_regions'));
    }

    public function create()
    {
        abort_if(Gate::denies('product_sku_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = Product::all()->pluck('afa_model_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        $prod_dev_stages = ProductDevelopmentStage::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sizes = BedSizesByRegion::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.productSkus.create', compact('products', 'prod_dev_stages', 'sizes'));
    }

    public function store(StoreProductSkuRequest $request)
    {
        $productSku = ProductSku::create($request->all());

        return redirect()->route('admin.product-skus.index');
    }

    public function edit(ProductSku $productSku)
    {
        abort_if(Gate::denies('product_sku_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = Product::all()->pluck('afa_model_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        $prod_dev_stages = ProductDevelopmentStage::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sizes = BedSizesByRegion::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $productSku->load('product', 'prod_dev_stage', 'size');

        return view('admin.productSkus.edit', compact('products', 'prod_dev_stages', 'sizes', 'productSku'));
    }

    public function update(UpdateProductSkuRequest $request, ProductSku $productSku)
    {
        $productSku->update($request->all());

        return redirect()->route('admin.product-skus.index');
    }

    public function show(ProductSku $productSku)
    {
        abort_if(Gate::denies('product_sku_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productSku->load('product', 'prod_dev_stage', 'size', 'skuPrices', 'productSkuComponentParts', 'productSkuOrderItems', 'relatedSkuDocuments');

        return view('admin.productSkus.show', compact('productSku'));
    }

    public function destroy(ProductSku $productSku)
    {
        abort_if(Gate::denies('product_sku_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productSku->delete();

        return back();
    }

    public function massDestroy(MassDestroyProductSkuRequest $request)
    {
        ProductSku::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
