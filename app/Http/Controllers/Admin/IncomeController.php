<?php

namespace App\Http\Controllers\Admin;

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
use Yajra\DataTables\Facades\DataTables;

class IncomeController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('income_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Income::with(['income_category', 'bank_account', 'exchange_rate', 'currency', 'order'])->select(sprintf('%s.*', (new Income())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'income_show';
                $editGate = 'income_edit';
                $deleteGate = 'income_delete';
                $crudRoutePart = 'incomes';

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
            $table->addColumn('income_category_name', function ($row) {
                return $row->income_category ? $row->income_category->name : '';
            });

            $table->editColumn('amount', function ($row) {
                return $row->amount ? $row->amount : '';
            });
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
            });
            $table->addColumn('bank_account_name', function ($row) {
                return $row->bank_account ? $row->bank_account->name : '';
            });

            $table->addColumn('currency_name', function ($row) {
                return $row->currency ? $row->currency->name : '';
            });

            $table->editColumn('currency.alpha_3', function ($row) {
                return $row->currency ? (is_string($row->currency) ? $row->currency : $row->currency->alpha_3) : '';
            });
            $table->addColumn('order_afa_order_num', function ($row) {
                return $row->order ? $row->order->afa_order_num : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'income_category', 'bank_account', 'currency', 'order']);

            return $table->make(true);
        }

        $income_categories = IncomeCategory::get();
        $bank_accounts     = BankAccount::get();
        $currency_rates    = CurrencyRate::get();
        $currencies        = Currency::get();
        $orders            = Order::get();

        return view('admin.incomes.index', compact('income_categories', 'bank_accounts', 'currency_rates', 'currencies', 'orders'));
    }

    public function create()
    {
        abort_if(Gate::denies('income_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $income_categories = IncomeCategory::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $bank_accounts = BankAccount::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $exchange_rates = CurrencyRate::all()->pluck('usd_value', 'id')->prepend(trans('global.pleaseSelect'), '');

        $currencies = Currency::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $orders = Order::all()->pluck('afa_order_num', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.incomes.create', compact('income_categories', 'bank_accounts', 'exchange_rates', 'currencies', 'orders'));
    }

    public function store(StoreIncomeRequest $request)
    {
        $income = Income::create($request->all());

        return redirect()->route('admin.incomes.index');
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

        return view('admin.incomes.edit', compact('income_categories', 'bank_accounts', 'exchange_rates', 'currencies', 'orders', 'income'));
    }

    public function update(UpdateIncomeRequest $request, Income $income)
    {
        $income->update($request->all());

        return redirect()->route('admin.incomes.index');
    }

    public function show(Income $income)
    {
        abort_if(Gate::denies('income_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $income->load('income_category', 'bank_account', 'exchange_rate', 'currency', 'order');

        return view('admin.incomes.show', compact('income'));
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
