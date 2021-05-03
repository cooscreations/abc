<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyPriceListGroupRequest;
use App\Http\Requests\StorePriceListGroupRequest;
use App\Http\Requests\UpdatePriceListGroupRequest;
use App\Models\PriceListGroup;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PriceListGroupsController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('price_list_group_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = PriceListGroup::query()->select(sprintf('%s.*', (new PriceListGroup())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'price_list_group_show';
                $editGate = 'price_list_group_edit';
                $deleteGate = 'price_list_group_delete';
                $crudRoutePart = 'price-list-groups';

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

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.priceListGroups.index');
    }

    public function create()
    {
        abort_if(Gate::denies('price_list_group_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.priceListGroups.create');
    }

    public function store(StorePriceListGroupRequest $request)
    {
        $priceListGroup = PriceListGroup::create($request->all());

        return redirect()->route('admin.price-list-groups.index');
    }

    public function edit(PriceListGroup $priceListGroup)
    {
        abort_if(Gate::denies('price_list_group_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.priceListGroups.edit', compact('priceListGroup'));
    }

    public function update(UpdatePriceListGroupRequest $request, PriceListGroup $priceListGroup)
    {
        $priceListGroup->update($request->all());

        return redirect()->route('admin.price-list-groups.index');
    }

    public function show(PriceListGroup $priceListGroup)
    {
        abort_if(Gate::denies('price_list_group_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $priceListGroup->load('groupPriceLists', 'priceGroupBedSizeGroups');

        return view('admin.priceListGroups.show', compact('priceListGroup'));
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
