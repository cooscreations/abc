<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyProductSkuLetterRequest;
use App\Http\Requests\StoreProductSkuLetterRequest;
use App\Http\Requests\UpdateProductSkuLetterRequest;
use App\Models\ProductSkuLetter;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ProductSkuLettersController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('product_sku_letter_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ProductSkuLetter::query()->select(sprintf('%s.*', (new ProductSkuLetter())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'product_sku_letter_show';
                $editGate = 'product_sku_letter_edit';
                $deleteGate = 'product_sku_letter_delete';
                $crudRoutePart = 'product-sku-letters';

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
            $table->editColumn('letter_code', function ($row) {
                return $row->letter_code ? $row->letter_code : '';
            });
            $table->editColumn('full_name', function ($row) {
                return $row->full_name ? $row->full_name : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.productSkuLetters.index');
    }

    public function create()
    {
        abort_if(Gate::denies('product_sku_letter_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.productSkuLetters.create');
    }

    public function store(StoreProductSkuLetterRequest $request)
    {
        $productSkuLetter = ProductSkuLetter::create($request->all());

        return redirect()->route('admin.product-sku-letters.index');
    }

    public function edit(ProductSkuLetter $productSkuLetter)
    {
        abort_if(Gate::denies('product_sku_letter_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.productSkuLetters.edit', compact('productSkuLetter'));
    }

    public function update(UpdateProductSkuLetterRequest $request, ProductSkuLetter $productSkuLetter)
    {
        $productSkuLetter->update($request->all());

        return redirect()->route('admin.product-sku-letters.index');
    }

    public function show(ProductSkuLetter $productSkuLetter)
    {
        abort_if(Gate::denies('product_sku_letter_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productSkuLetter->load('extraLettersUsedInSkuProducts');

        return view('admin.productSkuLetters.show', compact('productSkuLetter'));
    }

    public function destroy(ProductSkuLetter $productSkuLetter)
    {
        abort_if(Gate::denies('product_sku_letter_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productSkuLetter->delete();

        return back();
    }

    public function massDestroy(MassDestroyProductSkuLetterRequest $request)
    {
        ProductSkuLetter::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
