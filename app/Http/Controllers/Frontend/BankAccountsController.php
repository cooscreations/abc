<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyBankAccountRequest;
use App\Http\Requests\StoreBankAccountRequest;
use App\Http\Requests\UpdateBankAccountRequest;
use App\Models\Address;
use App\Models\BankAccount;
use App\Models\ContactCompany;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BankAccountsController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('bank_account_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bankAccounts = BankAccount::with(['company', 'address'])->get();

        $contact_companies = ContactCompany::get();

        $addresses = Address::get();

        return view('frontend.bankAccounts.index', compact('bankAccounts', 'contact_companies', 'addresses'));
    }

    public function create()
    {
        abort_if(Gate::denies('bank_account_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $companies = ContactCompany::all()->pluck('company_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $addresses = Address::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.bankAccounts.create', compact('companies', 'addresses'));
    }

    public function store(StoreBankAccountRequest $request)
    {
        $bankAccount = BankAccount::create($request->all());

        return redirect()->route('frontend.bank-accounts.index');
    }

    public function edit(BankAccount $bankAccount)
    {
        abort_if(Gate::denies('bank_account_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $companies = ContactCompany::all()->pluck('company_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $addresses = Address::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $bankAccount->load('company', 'address');

        return view('frontend.bankAccounts.edit', compact('companies', 'addresses', 'bankAccount'));
    }

    public function update(UpdateBankAccountRequest $request, BankAccount $bankAccount)
    {
        $bankAccount->update($request->all());

        return redirect()->route('frontend.bank-accounts.index');
    }

    public function show(BankAccount $bankAccount)
    {
        abort_if(Gate::denies('bank_account_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bankAccount->load('company', 'address', 'bankAccountExpenses', 'bankAccountIncomes');

        return view('frontend.bankAccounts.show', compact('bankAccount'));
    }

    public function destroy(BankAccount $bankAccount)
    {
        abort_if(Gate::denies('bank_account_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bankAccount->delete();

        return back();
    }

    public function massDestroy(MassDestroyBankAccountRequest $request)
    {
        BankAccount::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
