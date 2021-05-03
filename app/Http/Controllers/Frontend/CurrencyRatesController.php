<?php

namespace App\Http\Controllers\Frontend;

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

class CurrencyRatesController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('currency_rate_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $currencyRates = CurrencyRate::with(['currency'])->get();

        $currencies = Currency::get();

        return view('frontend.currencyRates.index', compact('currencyRates', 'currencies'));
    }

    public function create()
    {
        abort_if(Gate::denies('currency_rate_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $currencies = Currency::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.currencyRates.create', compact('currencies'));
    }

    public function store(StoreCurrencyRateRequest $request)
    {
        $currencyRate = CurrencyRate::create($request->all());

        return redirect()->route('frontend.currency-rates.index');
    }

    public function edit(CurrencyRate $currencyRate)
    {
        abort_if(Gate::denies('currency_rate_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $currencies = Currency::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $currencyRate->load('currency');

        return view('frontend.currencyRates.edit', compact('currencies', 'currencyRate'));
    }

    public function update(UpdateCurrencyRateRequest $request, CurrencyRate $currencyRate)
    {
        $currencyRate->update($request->all());

        return redirect()->route('frontend.currency-rates.index');
    }

    public function show(CurrencyRate $currencyRate)
    {
        abort_if(Gate::denies('currency_rate_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $currencyRate->load('currency', 'exchangeRateExpenses', 'exchangeRateIncomes');

        return view('frontend.currencyRates.show', compact('currencyRate'));
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
