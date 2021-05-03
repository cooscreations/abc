@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.productNickname.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.product-nicknames.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.productNickname.fields.id') }}
                        </th>
                        <td>
                            {{ $productNickname->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productNickname.fields.name') }}
                        </th>
                        <td>
                            {{ $productNickname->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productNickname.fields.company') }}
                        </th>
                        <td>
                            {{ $productNickname->company->company_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productNickname.fields.product') }}
                        </th>
                        <td>
                            {{ $productNickname->product->afa_model_number ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productNickname.fields.alt_code') }}
                        </th>
                        <td>
                            {{ $productNickname->alt_code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productNickname.fields.description') }}
                        </th>
                        <td>
                            {!! $productNickname->description !!}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.product-nicknames.index') }}">
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
            <a class="nav-link" href="#primary_nickname_products" role="tab" data-toggle="tab">
                {{ trans('cruds.product.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="primary_nickname_products">
            @includeIf('admin.productNicknames.relationships.primaryNicknameProducts', ['products' => $productNickname->primaryNicknameProducts])
        </div>
    </div>
</div>

@endsection