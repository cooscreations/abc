<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyProductSkuLetterRequest;
use App\Http\Requests\StoreProductSkuLetterRequest;
use App\Http\Requests\UpdateProductSkuLetterRequest;
use App\Models\ProductSkuLetter;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductSkuLettersController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('product_sku_letter_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productSkuLetters = ProductSkuLetter::all();

        return view('frontend.productSkuLetters.index', compact('productSkuLetters'));
    }

    public function create()
    {
        abort_if(Gate::denies('product_sku_letter_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.productSkuLetters.create');
    }

    public function store(StoreProductSkuLetterRequest $request)
    {
        $productSkuLetter = ProductSkuLetter::create($request->all());

        return redirect()->route('frontend.product-sku-letters.index');
    }

    public function edit(ProductSkuLetter $productSkuLetter)
    {
        abort_if(Gate::denies('product_sku_letter_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.productSkuLetters.edit', compact('productSkuLetter'));
    }

    public function update(UpdateProductSkuLetterRequest $request, ProductSkuLetter $productSkuLetter)
    {
        $productSkuLetter->update($request->all());

        return redirect()->route('frontend.product-sku-letters.index');
    }

    public function show(ProductSkuLetter $productSkuLetter)
    {
        abort_if(Gate::denies('product_sku_letter_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productSkuLetter->load('extraLettersUsedInSkuProducts');

        return view('frontend.productSkuLetters.show', compact('productSkuLetter'));
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
