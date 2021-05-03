<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyProductDevelopmentStageRequest;
use App\Http\Requests\StoreProductDevelopmentStageRequest;
use App\Http\Requests\UpdateProductDevelopmentStageRequest;
use App\Models\ProductDevelopmentStage;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ProductDevelopmentStagesController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('product_development_stage_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ProductDevelopmentStage::query()->select(sprintf('%s.*', (new ProductDevelopmentStage())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'product_development_stage_show';
                $editGate = 'product_development_stage_edit';
                $deleteGate = 'product_development_stage_delete';
                $crudRoutePart = 'product-development-stages';

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

        return view('admin.productDevelopmentStages.index');
    }

    public function create()
    {
        abort_if(Gate::denies('product_development_stage_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.productDevelopmentStages.create');
    }

    public function store(StoreProductDevelopmentStageRequest $request)
    {
        $productDevelopmentStage = ProductDevelopmentStage::create($request->all());

        return redirect()->route('admin.product-development-stages.index');
    }

    public function edit(ProductDevelopmentStage $productDevelopmentStage)
    {
        abort_if(Gate::denies('product_development_stage_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.productDevelopmentStages.edit', compact('productDevelopmentStage'));
    }

    public function update(UpdateProductDevelopmentStageRequest $request, ProductDevelopmentStage $productDevelopmentStage)
    {
        $productDevelopmentStage->update($request->all());

        return redirect()->route('admin.product-development-stages.index');
    }

    public function show(ProductDevelopmentStage $productDevelopmentStage)
    {
        abort_if(Gate::denies('product_development_stage_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productDevelopmentStage->load('prodDevStageProductSkus');

        return view('admin.productDevelopmentStages.show', compact('productDevelopmentStage'));
    }

    public function destroy(ProductDevelopmentStage $productDevelopmentStage)
    {
        abort_if(Gate::denies('product_development_stage_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productDevelopmentStage->delete();

        return back();
    }

    public function massDestroy(MassDestroyProductDevelopmentStageRequest $request)
    {
        ProductDevelopmentStage::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
