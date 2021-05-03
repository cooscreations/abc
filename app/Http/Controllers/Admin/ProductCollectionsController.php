<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyProductCollectionRequest;
use App\Http\Requests\StoreProductCollectionRequest;
use App\Http\Requests\UpdateProductCollectionRequest;
use App\Models\ProductCollection;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ProductCollectionsController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('product_collection_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ProductCollection::query()->select(sprintf('%s.*', (new ProductCollection())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'product_collection_show';
                $editGate = 'product_collection_edit';
                $deleteGate = 'product_collection_delete';
                $crudRoutePart = 'product-collections';

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

        return view('admin.productCollections.index');
    }

    public function create()
    {
        abort_if(Gate::denies('product_collection_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.productCollections.create');
    }

    public function store(StoreProductCollectionRequest $request)
    {
        $productCollection = ProductCollection::create($request->all());

        return redirect()->route('admin.product-collections.index');
    }

    public function edit(ProductCollection $productCollection)
    {
        abort_if(Gate::denies('product_collection_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.productCollections.edit', compact('productCollection'));
    }

    public function update(UpdateProductCollectionRequest $request, ProductCollection $productCollection)
    {
        $productCollection->update($request->all());

        return redirect()->route('admin.product-collections.index');
    }

    public function show(ProductCollection $productCollection)
    {
        abort_if(Gate::denies('product_collection_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productCollection->load('productCollectionProducts', 'productCollectionProductCodeGroups');

        return view('admin.productCollections.show', compact('productCollection'));
    }

    public function destroy(ProductCollection $productCollection)
    {
        abort_if(Gate::denies('product_collection_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productCollection->delete();

        return back();
    }

    public function massDestroy(MassDestroyProductCollectionRequest $request)
    {
        ProductCollection::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
