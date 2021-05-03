@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.currencyRate.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.currency-rates.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.currencyRate.fields.id') }}
                        </th>
                        <td>
                            {{ $currencyRate->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.currencyRate.fields.usd_value') }}
                        </th>
                        <td>
                            {{ $currencyRate->usd_value }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.currencyRate.fields.currency') }}
                        </th>
                        <td>
                            {{ $currencyRate->currency->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.currencyRate.fields.valid_until') }}
                        </th>
                        <td>
                            {{ $currencyRate->valid_until }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.currency-rates.index') }}">
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
            <a class="nav-link" href="#exchange_rate_expenses" role="tab" data-toggle="tab">
                {{ trans('cruds.expense.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#exchange_rate_incomes" role="tab" data-toggle="tab">
                {{ trans('cruds.income.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="exchange_rate_expenses">
            @includeIf('admin.currencyRates.relationships.exchangeRateExpenses', ['expenses' => $currencyRate->exchangeRateExpenses])
        </div>
        <div class="tab-pane" role="tabpanel" id="exchange_rate_incomes">
            @includeIf('admin.currencyRates.relationships.exchangeRateIncomes', ['incomes' => $currencyRate->exchangeRateIncomes])
        </div>
    </div>
</div>

@endsection