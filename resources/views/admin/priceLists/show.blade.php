@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.priceList.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.price-lists.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.priceList.fields.id') }}
                        </th>
                        <td>
                            {{ $priceList->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.priceList.fields.name') }}
                        </th>
                        <td>
                            {{ $priceList->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.priceList.fields.type') }}
                        </th>
                        <td>
                            {{ $priceList->type->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.priceList.fields.group') }}
                        </th>
                        <td>
                            {{ $priceList->group->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.price-lists.index') }}">
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
            <a class="nav-link" href="#price_list_prices" role="tab" data-toggle="tab">
                {{ trans('cruds.price.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="price_list_prices">
            @includeIf('admin.priceLists.relationships.priceListPrices', ['prices' => $priceList->priceListPrices])
        </div>
    </div>
</div>

@endsection