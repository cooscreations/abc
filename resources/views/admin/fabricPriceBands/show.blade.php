@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.fabricPriceBand.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.fabric-price-bands.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.fabricPriceBand.fields.id') }}
                        </th>
                        <td>
                            {{ $fabricPriceBand->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fabricPriceBand.fields.name') }}
                        </th>
                        <td>
                            {{ $fabricPriceBand->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fabricPriceBand.fields.band_letter') }}
                        </th>
                        <td>
                            {{ $fabricPriceBand->band_letter }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fabricPriceBand.fields.description') }}
                        </th>
                        <td>
                            {!! $fabricPriceBand->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fabricPriceBand.fields.cny_start_price') }}
                        </th>
                        <td>
                            {{ $fabricPriceBand->cny_start_price }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fabricPriceBand.fields.cny_finish_price') }}
                        </th>
                        <td>
                            {{ $fabricPriceBand->cny_finish_price }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.fabric-price-bands.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection