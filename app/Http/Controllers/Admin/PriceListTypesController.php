<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyPriceListTypeRequest;
use App\Http\Requests\StorePriceListTypeRequest;
use App\Http\Requests\UpdatePriceListTypeRequest;
use App\Models\PriceListType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PriceListTypesController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('price_list_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = PriceListType::query()->select(sprintf('%s.*', (new PriceListType())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'price_list_type_show';
                $editGate = 'price_list_type_edit';
                $deleteGate = 'price_list_type_delete';
                $crudRoutePart = 'price-list-types';

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

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.priceListTypes.index');
    }

    public function create()
    {
        abort_if(Gate::denies('price_list_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.priceListTypes.create');
    }

    public function store(StorePriceListTypeRequest $request)
    {
        $priceListType = PriceListType::create($request->all());

        return redirect()->route('admin.price-list-types.index');
    }

    public function edit(PriceListType $priceListType)
    {
        abort_if(Gate::denies('price_list_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.priceListTypes.edit', compact('priceListType'));
    }

    public function update(UpdatePriceListTypeRequest $request, PriceListType $priceListType)
    {
        $priceListType->update($request->all());

        return redirect()->route('admin.price-list-types.index');
    }

    public function show(PriceListType $priceListType)
    {
        abort_if(Gate::denies('price_list_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $priceListType->load('typePriceLists');

        return view('admin.priceListTypes.show', compact('priceListType'));
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
