<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyExpenseRequest;
use App\Http\Requests\StoreExpenseRequest;
use App\Http\Requests\UpdateExpenseRequest;
use App\Models\BankAccount;
use App\Models\Currency;
use App\Models\CurrencyRate;
use App\Models\Expense;
use App\Models\ExpenseCategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ExpenseController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('expense_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Expense::with(['expense_category', 'bank_account', 'currency', 'exchange_rate'])->select(sprintf('%s.*', (new Expense())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'expense_show';
                $editGate = 'expense_edit';
                $deleteGate = 'expense_delete';
                $crudRoutePart = 'expenses';

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
            $table->addColumn('expense_category_name', function ($row) {
                return $row->expense_category ? $row->expense_category->name : '';
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
            $table->editColumn('usd_amount', function ($row) {
                return $row->usd_amount ? $row->usd_amount : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'expense_category', 'bank_account', 'currency']);

            return $table->make(true);
        }

        $expense_categories = ExpenseCategory::get();
        $bank_accounts      = BankAccount::get();
        $currencies         = Currency::get();
        $currency_rates     = CurrencyRate::get();

        return view('admin.expenses.index', compact('expense_categories', 'bank_accounts', 'currencies', 'currency_rates'));
    }

    public function create()
    {
        abort_if(Gate::denies('expense_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $expense_categories = ExpenseCategory::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $bank_accounts = BankAccount::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $currencies = Currency::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $exchange_rates = CurrencyRate::all()->pluck('usd_value', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.expenses.create', compact('expense_categories', 'bank_accounts', 'currencies', 'exchange_rates'));
    }

    public function store(StoreExpenseRequest $request)
    {
        $expense = Expense::create($request->all());

        return redirect()->route('admin.expenses.index');
    }

    public function edit(Expense $expense)
    {
        abort_if(Gate::denies('expense_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $expense_categories = ExpenseCategory::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $bank_accounts = BankAccount::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $currencies = Currency::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $exchange_rates = CurrencyRate::all()->pluck('usd_value', 'id')->prepend(trans('global.pleaseSelect'), '');

        $expense->load('expense_category', 'bank_account', 'currency', 'exchange_rate');

        return view('admin.expenses.edit', compact('expense_categories', 'bank_accounts', 'currencies', 'exchange_rates', 'expense'));
    }

    public function update(UpdateExpenseRequest $request, Expense $expense)
    {
        $expense->update($request->all());

        return redirect()->route('admin.expenses.index');
    }

    public function show(Expense $expense)
    {
        abort_if(Gate::denies('expense_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $expense->load('expense_category', 'bank_account', 'currency', 'exchange_rate');

        return view('admin.expenses.show', compact('expense'));
    }

    public function destroy(Expense $expense)
    {
        abort_if(Gate::denies('expense_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $expense->delete();

        return back();
    }

    public function massDestroy(MassDestroyExpenseRequest $request)
    {
        Expense::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
