<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyCurrencyRateRequest;
use App\Http\Requests\StoreCurrencyRateRequest;
use App\Http\Requests\UpdateCurrencyRateRequest;
use App\Models\Currency;
use App\Models\CurrencyRate;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class CurrencyRatesController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('currency_rate_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = CurrencyRate::with(['currency'])->select(sprintf('%s.*', (new CurrencyRate())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'currency_rate_show';
                $editGate = 'currency_rate_edit';
                $deleteGate = 'currency_rate_delete';
                $crudRoutePart = 'currency-rates';

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
            $table->editColumn('usd_value', function ($row) {
                return $row->usd_value ? $row->usd_value : '';
            });
            $table->addColumn('currency_name', function ($row) {
                return $row->currency ? $row->currency->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'currency']);

            return $table->make(true);
        }

        $currencies = Currency::get();

        return view('admin.currencyRates.index', compact('currencies'));
    }

    public function create()
    {
        abort_if(Gate::denies('currency_rate_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $currencies = Currency::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.currencyRates.create', compact('currencies'));
    }

    public function store(StoreCurrencyRateRequest $request)
    {
        $currencyRate = CurrencyRate::create($request->all());

        return redirect()->route('admin.currency-rates.index');
    }

    public function edit(CurrencyRate $currencyRate)
    {
        abort_if(Gate::denies('currency_rate_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $currencies = Currency::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $currencyRate->load('currency');

        return view('admin.currencyRates.edit', compact('currencies', 'currencyRate'));
    }

    public function update(UpdateCurrencyRateRequest $request, CurrencyRate $currencyRate)
    {
        $currencyRate->update($request->all());

        return redirect()->route('admin.currency-rates.index');
    }

    public function show(CurrencyRate $currencyRate)
    {
        abort_if(Gate::denies('currency_rate_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $currencyRate->load('currency', 'exchangeRateExpenses', 'exchangeRateIncomes');

        return view('admin.currencyRates.show', compact('currencyRate'));
    }

    public function destroy(CurrencyRate $currencyRate)
    {
        abort_if(Gate::denies('currency_rate_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $currencyRate->delete();

        return back();
    }

    public function massDestroy(MassDestroyCurrencyRateRequest $request)
    {
        CurrencyRate::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
