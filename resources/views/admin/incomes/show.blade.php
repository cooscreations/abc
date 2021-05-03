@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.income.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.incomes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.income.fields.id') }}
                        </th>
                        <td>
                            {{ $income->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.income.fields.income_category') }}
                        </th>
                        <td>
                            {{ $income->income_category->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.income.fields.entry_date') }}
                        </th>
                        <td>
                            {{ $income->entry_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.income.fields.amount') }}
                        </th>
                        <td>
                            {{ $income->amount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.income.fields.description') }}
                        </th>
                        <td>
                            {{ $income->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.income.fields.bank_account') }}
                        </th>
                        <td>
                            {{ $income->bank_account->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.income.fields.usd_amount') }}
                        </th>
                        <td>
                            {{ $income->usd_amount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.income.fields.exchange_rate') }}
                        </th>
                        <td>
                            {{ $income->exchange_rate->usd_value ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.income.fields.currency') }}
                        </th>
                        <td>
                            {{ $income->currency->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.income.fields.order') }}
                        </th>
                        <td>
                            {{ $income->order->afa_order_num ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.income.fields.reference') }}
                        </th>
                        <td>
                            {{ $income->reference }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.incomes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection