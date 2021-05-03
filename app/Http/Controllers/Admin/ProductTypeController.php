<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyProductTypeRequest;
use App\Http\Requests\StoreProductTypeRequest;
use App\Http\Requests\UpdateProductTypeRequest;
use App\Models\ProductType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ProductTypeController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('product_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ProductType::query()->select(sprintf('%s.*', (new ProductType())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'product_type_show';
                $editGate = 'product_type_edit';
                $deleteGate = 'product_type_delete';
                $crudRoutePart = 'product-types';

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
            $table->editColumn('list_order', function ($row) {
                return $row->list_order ? $row->list_order : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.productTypes.index');
    }

    public function create()
    {
        abort_if(Gate::denies('product_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.productTypes.create');
    }

    public function store(StoreProductTypeRequest $request)
    {
        $productType = ProductType::create($request->all());

        return redirect()->route('admin.product-types.index');
    }

    public function edit(ProductType $productType)
    {
        abort_if(Gate::denies('product_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.productTypes.edit', compact('productType'));
    }

    public function update(UpdateProductTypeRequest $request, ProductType $productType)
    {
        $productType->update($request->all());

        return redirect()->route('admin.product-types.index');
    }

    public function show(ProductType $productType)
    {
        abort_if(Gate::denies('product_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productType->load('productTypeProductCodeGroups', 'client1ProductTypeSupplierAudits');

        return view('admin.productTypes.show', compact('productType'));
    }

    public function destroy(ProductType $productType)
    {
        abort_if(Gate::denies('product_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productType->delete();

        return back();
    }

    public function massDestroy(MassDestroyProductTypeRequest $request)
    {
        ProductType::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
