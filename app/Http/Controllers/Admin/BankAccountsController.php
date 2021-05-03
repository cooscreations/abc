<?php

namespace App\Http\Controllers\Admin;

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
use Yajra\DataTables\Facades\DataTables;

class BankAccountsController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('bank_account_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = BankAccount::with(['company', 'address'])->select(sprintf('%s.*', (new BankAccount())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'bank_account_show';
                $editGate = 'bank_account_edit';
                $deleteGate = 'bank_account_delete';
                $crudRoutePart = 'bank-accounts';

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
            $table->editColumn('bank_name', function ($row) {
                return $row->bank_name ? $row->bank_name : '';
            });
            $table->editColumn('beneficiary', function ($row) {
                return $row->beneficiary ? $row->beneficiary : '';
            });
            $table->addColumn('company_company_name', function ($row) {
                return $row->company ? $row->company->company_name : '';
            });

            $table->editColumn('company.company_short_code', function ($row) {
                return $row->company ? (is_string($row->company) ? $row->company : $row->company->company_short_code) : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'company']);

            return $table->make(true);
        }

        $contact_companies = ContactCompany::get();
        $addresses         = Address::get();

        return view('admin.bankAccounts.index', compact('contact_companies', 'addresses'));
    }

    public function create()
    {
        abort_if(Gate::denies('bank_account_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $companies = ContactCompany::all()->pluck('company_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $addresses = Address::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.bankAccounts.create', compact('companies', 'addresses'));
    }

    public function store(StoreBankAccountRequest $request)
    {
        $bankAccount = BankAccount::create($request->all());

        return redirect()->route('admin.bank-accounts.index');
    }

    public function edit(BankAccount $bankAccount)
    {
        abort_if(Gate::denies('bank_account_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $companies = ContactCompany::all()->pluck('company_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $addresses = Address::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $bankAccount->load('company', 'address');

        return view('admin.bankAccounts.edit', compact('companies', 'addresses', 'bankAccount'));
    }

    public function update(UpdateBankAccountRequest $request, BankAccount $bankAccount)
    {
        $bankAccount->update($request->all());

        return redirect()->route('admin.bank-accounts.index');
    }

    public function show(BankAccount $bankAccount)
    {
        abort_if(Gate::denies('bank_account_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bankAccount->load('company', 'address', 'bankAccountExpenses', 'bankAccountIncomes', 'afaBankAccountToPayOrders');

        return view('admin.bankAccounts.show', compact('bankAccount'));
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
