<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyProductFunctionRequest;
use App\Http\Requests\StoreProductFunctionRequest;
use App\Http\Requests\UpdateProductFunctionRequest;
use App\Models\ProductFunction;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ProductFunctionsController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('product_function_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ProductFunction::query()->select(sprintf('%s.*', (new ProductFunction())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'product_function_show';
                $editGate = 'product_function_edit';
                $deleteGate = 'product_function_delete';
                $crudRoutePart = 'product-functions';

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

        return view('admin.productFunctions.index');
    }

    public function create()
    {
        abort_if(Gate::denies('product_function_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.productFunctions.create');
    }

    public function store(StoreProductFunctionRequest $request)
    {
        $productFunction = ProductFunction::create($request->all());

        return redirect()->route('admin.product-functions.index');
    }

    public function edit(ProductFunction $productFunction)
    {
        abort_if(Gate::denies('product_function_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.productFunctions.edit', compact('productFunction'));
    }

    public function update(UpdateProductFunctionRequest $request, ProductFunction $productFunction)
    {
        $productFunction->update($request->all());

        return redirect()->route('admin.product-functions.index');
    }

    public function show(ProductFunction $productFunction)
    {
        abort_if(Gate::denies('product_function_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productFunction->load('defaultFunctionProducts', 'productFunctionProductCodeGroups');

        return view('admin.productFunctions.show', compact('productFunction'));
    }

    public function destroy(ProductFunction $productFunction)
    {
        abort_if(Gate::denies('product_function_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productFunction->delete();

        return back();
    }

    public function massDestroy(MassDestroyProductFunctionRequest $request)
    {
        ProductFunction::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
