<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyPriceListRequest;
use App\Http\Requests\StorePriceListRequest;
use App\Http\Requests\UpdatePriceListRequest;
use App\Models\PriceList;
use App\Models\PriceListGroup;
use App\Models\PriceListType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PriceListsController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('price_list_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $priceLists = PriceList::with(['type', 'group'])->get();

        return view('frontend.priceLists.index', compact('priceLists'));
    }

    public function create()
    {
        abort_if(Gate::denies('price_list_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $types = PriceListType::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $groups = PriceListGroup::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.priceLists.create', compact('types', 'groups'));
    }

    public function store(StorePriceListRequest $request)
    {
        $priceList = PriceList::create($request->all());

        return redirect()->route('frontend.price-lists.index');
    }

    public function edit(PriceList $priceList)
    {
        abort_if(Gate::denies('price_list_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $types = PriceListType::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $groups = PriceListGroup::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $priceList->load('type', 'group');

        return view('frontend.priceLists.edit', compact('types', 'groups', 'priceList'));
    }

    public function update(UpdatePriceListRequest $request, PriceList $priceList)
    {
        $priceList->update($request->all());

        return redirect()->route('frontend.price-lists.index');
    }

    public function show(PriceList $priceList)
    {
        abort_if(Gate::denies('price_list_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $priceList->load('type', 'group', 'priceListPrices');

        return view('frontend.priceLists.show', compact('priceList'));
    }

    public function destroy(PriceList $priceList)
    {
        abort_if(Gate::denies('price_list_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $priceList->delete();

        return back();
    }

    public function massDestroy(MassDestroyPriceListRequest $request)
    {
        PriceList::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
