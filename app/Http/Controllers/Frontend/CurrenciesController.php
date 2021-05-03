<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyCurrencyRequest;
use App\Http\Requests\StoreCurrencyRequest;
use App\Http\Requests\UpdateCurrencyRequest;
use App\Models\Country;
use App\Models\Currency;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CurrenciesController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('currency_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $currencies = Currency::with(['countries'])->get();

        $countries = Country::get();

        return view('frontend.currencies.index', compact('currencies', 'countries'));
    }

    public function create()
    {
        abort_if(Gate::denies('currency_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $countries = Country::all()->pluck('name', 'id');

        return view('frontend.currencies.create', compact('countries'));
    }

    public function store(StoreCurrencyRequest $request)
    {
        $currency = Currency::create($request->all());
        $currency->countries()->sync($request->input('countries', []));

        return redirect()->route('frontend.currencies.index');
    }

    public function edit(Currency $currency)
    {
        abort_if(Gate::denies('currency_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $countries = Country::all()->pluck('name', 'id');

        $currency->load('countries');

        return view('frontend.currencies.edit', compact('countries', 'currency'));
    }

    public function update(UpdateCurrencyRequest $request, Currency $currency)
    {
        $currency->update($request->all());
        $currency->countries()->sync($request->input('countries', []));

        return redirect()->route('frontend.currencies.index');
    }

    public function show(Currency $currency)
    {
        abort_if(Gate::denies('currency_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $currency->load('countries', 'defaultCurrencyCountries', 'currencyCurrencyRates', 'currencyExpenses', 'currencyIncomes');

        return view('frontend.currencies.show', compact('currency'));
    }

    public function destroy(Currency $currency)
    {
        abort_if(Gate::denies('currency_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $currency->delete();

        return back();
    }

    public function massDestroy(MassDestroyCurrencyRequest $request)
    {
        Currency::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
