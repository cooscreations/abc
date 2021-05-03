@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.currencyRate.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.currency-rates.index') }}">
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
                            <a class="btn btn-default" href="{{ route('frontend.currency-rates.index') }}">
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