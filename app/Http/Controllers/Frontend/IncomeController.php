<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyIncomeRequest;
use App\Http\Requests\StoreIncomeRequest;
use App\Http\Requests\UpdateIncomeRequest;
use App\Models\BankAccount;
use App\Models\Currency;
use App\Models\CurrencyRate;
use App\Models\Income;
use App\Models\IncomeCategory;
use App\Models\Order;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IncomeController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('income_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $incomes = Income::with(['income_category', 'bank_account', 'exchange_rate', 'currency', 'order'])->get();

        $income_categories = IncomeCategory::get();

        $bank_accounts = BankAccount::get();

        $currency_rates = CurrencyRate::get();

        $currencies = Currency::get();

        $orders = Order::get();

        return view('frontend.incomes.index', compact('incomes', 'income_categories', 'bank_accounts', 'currency_rates', 'currencies', 'orders'));
    }

    public function create()
    {
        abort_if(Gate::denies('income_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $income_categories = IncomeCategory::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $bank_accounts = BankAccount::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $exchange_rates = CurrencyRate::all()->pluck('usd_value', 'id')->prepend(trans('global.pleaseSelect'), '');

        $currencies = Currency::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $orders = Order::all()->pluck('afa_order_num', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.incomes.create', compact('income_categories', 'bank_accounts', 'exchange_rates', 'currencies', 'orders'));
    }

    public function store(StoreIncomeRequest $request)
    {
        $income = Income::create($request->all());

        return redirect()->route('frontend.incomes.index');
    }

    public function edit(Income $income)
    {
        abort_if(Gate::denies('income_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $income_categories = IncomeCategory::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $bank_accounts = BankAccount::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $exchange_rates = CurrencyRate::all()->pluck('usd_value', 'id')->prepend(trans('global.pleaseSelect'), '');

        $currencies = Currency::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $orders = Order::all()->pluck('afa_order_num', 'id')->prepend(trans('global.pleaseSelect'), '');

        $income->load('income_category', 'bank_account', 'exchange_rate', 'currency', 'order');

        return view('frontend.incomes.edit', compact('income_categories', 'bank_accounts', 'exchange_rates', 'currencies', 'orders', 'income'));
    }

    public function update(UpdateIncomeRequest $request, Income $income)
    {
        $income->update($request->all());

        return redirect()->route('frontend.incomes.index');
    }

    public function show(Income $income)
    {
        abort_if(Gate::denies('income_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $income->load('income_category', 'bank_account', 'exchange_rate', 'currency', 'order');

        return view('frontend.incomes.show', compact('income'));
    }

    public function destroy(Income $income)
    {
        abort_if(Gate::denies('income_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $income->delete();

        return back();
    }

    public function massDestroy(MassDestroyIncomeRequest $request)
    {
        Income::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
