<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyPriceListTypeRequest;
use App\Http\Requests\StorePriceListTypeRequest;
use App\Http\Requests\UpdatePriceListTypeRequest;
use App\Models\PriceListType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PriceListTypesController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('price_list_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $priceListTypes = PriceListType::all();

        return view('frontend.priceListTypes.index', compact('priceListTypes'));
    }

    public function create()
    {
        abort_if(Gate::denies('price_list_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.priceListTypes.create');
    }

    public function store(StorePriceListTypeRequest $request)
    {
        $priceListType = PriceListType::create($request->all());

        return redirect()->route('frontend.price-list-types.index');
    }

    public function edit(PriceListType $priceListType)
    {
        abort_if(Gate::denies('price_list_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.priceListTypes.edit', compact('priceListType'));
    }

    public function update(UpdatePriceListTypeRequest $request, PriceListType $priceListType)
    {
        $priceListType->update($request->all());

        return redirect()->route('frontend.price-list-types.index');
    }

    public function show(PriceListType $priceListType)
    {
        abort_if(Gate::denies('price_list_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $priceListType->load('typePriceLists');

        return view('frontend.priceListTypes.show', compact('priceListType'));
    }

    public function destroy(PriceListType $priceListType)
    {
        abort_if(Gate::denies('price_list_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $priceListType->delete();

        return back();
    }

    public function massDestroy(MassDestroyPriceListTypeRequest $request)
    {
        PriceListType::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
