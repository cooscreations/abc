@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.currency.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.currencies.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.currency.fields.id') }}
                        </th>
                        <td>
                            {{ $currency->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.currency.fields.name') }}
                        </th>
                        <td>
                            {{ $currency->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.currency.fields.symbol') }}
                        </th>
                        <td>
                            {{ $currency->symbol }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.currency.fields.alpha_3') }}
                        </th>
                        <td>
                            {{ $currency->alpha_3 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.currency.fields.countries') }}
                        </th>
                        <td>
                            @foreach($currency->countries as $key => $countries)
                                <span class="label label-info">{{ $countries->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.currencies.index') }}">
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
            <a class="nav-link" href="#default_currency_countries" role="tab" data-toggle="tab">
                {{ trans('cruds.country.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#currency_currency_rates" role="tab" data-toggle="tab">
                {{ trans('cruds.currencyRate.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#currency_expenses" role="tab" data-toggle="tab">
                {{ trans('cruds.expense.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#currency_incomes" role="tab" data-toggle="tab">
                {{ trans('cruds.income.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="default_currency_countries">
            @includeIf('admin.currencies.relationships.defaultCurrencyCountries', ['countries' => $currency->defaultCurrencyCountries])
        </div>
        <div class="tab-pane" role="tabpanel" id="currency_currency_rates">
            @includeIf('admin.currencies.relationships.currencyCurrencyRates', ['currencyRates' => $currency->currencyCurrencyRates])
        </div>
        <div class="tab-pane" role="tabpanel" id="currency_expenses">
            @includeIf('admin.currencies.relationships.currencyExpenses', ['expenses' => $currency->currencyExpenses])
        </div>
        <div class="tab-pane" role="tabpanel" id="currency_incomes">
            @includeIf('admin.currencies.relationships.currencyIncomes', ['incomes' => $currency->currencyIncomes])
        </div>
    </div>
</div>

@endsection