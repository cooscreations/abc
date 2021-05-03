<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyPriceListGroupRequest;
use App\Http\Requests\StorePriceListGroupRequest;
use App\Http\Requests\UpdatePriceListGroupRequest;
use App\Models\PriceListGroup;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PriceListGroupsController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('price_list_group_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $priceListGroups = PriceListGroup::all();

        return view('frontend.priceListGroups.index', compact('priceListGroups'));
    }

    public function create()
    {
        abort_if(Gate::denies('price_list_group_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.priceListGroups.create');
    }

    public function store(StorePriceListGroupRequest $request)
    {
        $priceListGroup = PriceListGroup::create($request->all());

        return redirect()->route('frontend.price-list-groups.index');
    }

    public function edit(PriceListGroup $priceListGroup)
    {
        abort_if(Gate::denies('price_list_group_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.priceListGroups.edit', compact('priceListGroup'));
    }

    public function update(UpdatePriceListGroupRequest $request, PriceListGroup $priceListGroup)
    {
        $priceListGroup->update($request->all());

        return redirect()->route('frontend.price-list-groups.index');
    }

    public function show(PriceListGroup $priceListGroup)
    {
        abort_if(Gate::denies('price_list_group_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $priceListGroup->load('groupPriceLists', 'priceGroupBedSizeGroups');

        return view('frontend.priceListGroups.show', compact('priceListGroup'));
    }

    public function destroy(PriceListGroup $priceListGroup)
    {
        abort_if(Gate::denies('price_list_group_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $priceListGroup->delete();

        return back();
    }

    public function massDestroy(MassDestroyPriceListGroupRequest $request)
    {
        PriceListGroup::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
