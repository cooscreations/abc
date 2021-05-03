<?php

namespace App\Http\Controllers\Admin;

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
use Yajra\DataTables\Facades\DataTables;

class PriceListsController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('price_list_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = PriceList::with(['type', 'group'])->select(sprintf('%s.*', (new PriceList())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'price_list_show';
                $editGate = 'price_list_edit';
                $deleteGate = 'price_list_delete';
                $crudRoutePart = 'price-lists';

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
            $table->addColumn('type_name', function ($row) {
                return $row->type ? $row->type->name : '';
            });

            $table->addColumn('group_name', function ($row) {
                return $row->group ? $row->group->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'type', 'group']);

            return $table->make(true);
        }

        return view('admin.priceLists.index');
    }

    public function create()
    {
        abort_if(Gate::denies('price_list_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $types = PriceListType::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $groups = PriceListGroup::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.priceLists.create', compact('types', 'groups'));
    }

    public function store(StorePriceListRequest $request)
    {
        $priceList = PriceList::create($request->all());

        return redirect()->route('admin.price-lists.index');
    }

    public function edit(PriceList $priceList)
    {
        abort_if(Gate::denies('price_list_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $types = PriceListType::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $groups = PriceListGroup::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $priceList->load('type', 'group');

        return view('admin.priceLists.edit', compact('types', 'groups', 'priceList'));
    }

    public function update(UpdatePriceListRequest $request, PriceList $priceList)
    {
        $priceList->update($request->all());

        return redirect()->route('admin.price-lists.index');
    }

    public function show(PriceList $priceList)
    {
        abort_if(Gate::denies('price_list_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $priceList->load('type', 'group', 'priceListPrices');

        return view('admin.priceLists.show', compact('priceList'));
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
