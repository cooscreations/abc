<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyProductSizeNameRequest;
use App\Http\Requests\StoreProductSizeNameRequest;
use App\Http\Requests\UpdateProductSizeNameRequest;
use App\Models\ProductSizeName;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ProductSizeNamesController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('product_size_name_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ProductSizeName::query()->select(sprintf('%s.*', (new ProductSizeName())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'product_size_name_show';
                $editGate = 'product_size_name_edit';
                $deleteGate = 'product_size_name_delete';
                $crudRoutePart = 'product-size-names';

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
            $table->editColumn('code', function ($row) {
                return $row->code ? $row->code : '';
            });
            $table->editColumn('list_order', function ($row) {
                return $row->list_order ? $row->list_order : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.productSizeNames.index');
    }

    public function create()
    {
        abort_if(Gate::denies('product_size_name_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.productSizeNames.create');
    }

    public function store(StoreProductSizeNameRequest $request)
    {
        $productSizeName = ProductSizeName::create($request->all());

        return redirect()->route('admin.product-size-names.index');
    }

    public function edit(ProductSizeName $productSizeName)
    {
        abort_if(Gate::denies('product_size_name_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.productSizeNames.edit', compact('productSizeName'));
    }

    public function update(UpdateProductSizeNameRequest $request, ProductSizeName $productSizeName)
    {
        $productSizeName->update($request->all());

        return redirect()->route('admin.product-size-names.index');
    }

    public function show(ProductSizeName $productSizeName)
    {
        abort_if(Gate::denies('product_size_name_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productSizeName->load('sizeNameBedSizesByRegions');

        return view('admin.productSizeNames.show', compact('productSizeName'));
    }

    public function destroy(ProductSizeName $productSizeName)
    {
        abort_if(Gate::denies('product_size_name_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productSizeName->delete();

        return back();
    }

    public function massDestroy(MassDestroyProductSizeNameRequest $request)
    {
        ProductSizeName::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
