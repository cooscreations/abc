@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.bankAccount.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.bank-accounts.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.bankAccount.fields.id') }}
                        </th>
                        <td>
                            {{ $bankAccount->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bankAccount.fields.name') }}
                        </th>
                        <td>
                            {{ $bankAccount->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bankAccount.fields.bank_name') }}
                        </th>
                        <td>
                            {{ $bankAccount->bank_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bankAccount.fields.beneficiary') }}
                        </th>
                        <td>
                            {{ $bankAccount->beneficiary }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bankAccount.fields.company') }}
                        </th>
                        <td>
                            {{ $bankAccount->company->company_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bankAccount.fields.address') }}
                        </th>
                        <td>
                            {{ $bankAccount->address->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bankAccount.fields.account_number') }}
                        </th>
                        <td>
                            {{ $bankAccount->account_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bankAccount.fields.swift_code') }}
                        </th>
                        <td>
                            {{ $bankAccount->swift_code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bankAccount.fields.tlx_number') }}
                        </th>
                        <td>
                            {{ $bankAccount->tlx_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bankAccount.fields.default_comment_on_tnx') }}
                        </th>
                        <td>
                            {{ $bankAccount->default_comment_on_tnx }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bankAccount.fields.internal_notes') }}
                        </th>
                        <td>
                            {{ $bankAccount->internal_notes }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.bank-accounts.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#bank_account_expenses" role="tab" data-toggle="tab">
                {{ trans('cruds.expense.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#bank_account_incomes" role="tab" data-toggle="tab">
                {{ trans('cruds.income.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#afa_bank_account_to_pay_orders" role="tab" data-toggle="tab">
                {{ trans('cruds.order.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="bank_account_expenses">
            @includeIf('admin.bankAccounts.relationships.bankAccountExpenses', ['expenses' => $bankAccount->bankAccountExpenses])
        </div>
        <div class="tab-pane" role="tabpanel" id="bank_account_incomes">
            @includeIf('admin.bankAccounts.relationships.bankAccountIncomes', ['incomes' => $bankAccount->bankAccountIncomes])
        </div>
        <div class="tab-pane" role="tabpanel" id="afa_bank_account_to_pay_orders">
            @includeIf('admin.bankAccounts.relationships.afaBankAccountToPayOrders', ['orders' => $bankAccount->afaBankAccountToPayOrders])
        </div>
    </div>
</div>

@endsection