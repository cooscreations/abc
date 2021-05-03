@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.bankAccount.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.bank-accounts.index') }}">
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
                            <a class="btn btn-default" href="{{ route('frontend.bank-accounts.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection