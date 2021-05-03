@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.priceListType.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.price-list-types.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.priceListType.fields.id') }}
                        </th>
                        <td>
                            {{ $priceListType->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.priceListType.fields.name') }}
                        </th>
                        <td>
                            {{ $priceListType->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.priceListType.fields.description') }}
                        </th>
                        <td>
                            {{ $priceListType->description }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.price-list-types.index') }}">
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
            <a class="nav-link" href="#type_price_lists" role="tab" data-toggle="tab">
                {{ trans('cruds.priceList.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="type_price_lists">
            @includeIf('admin.priceListTypes.relationships.typePriceLists', ['priceLists' => $priceListType->typePriceLists])
        </div>
    </div>
</div>

@endsection