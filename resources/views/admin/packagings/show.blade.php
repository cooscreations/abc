@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.packaging.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.packagings.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.packaging.fields.id') }}
                        </th>
                        <td>
                            {{ $packaging->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.packaging.fields.product') }}
                        </th>
                        <td>
                            {{ $packaging->product->afa_model_number ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.packaging.fields.type') }}
                        </th>
                        <td>
                            {{ $packaging->type->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.packaging.fields.notes') }}
                        </th>
                        <td>
                            {{ $packaging->notes }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.packagings.index') }}">
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
            <a class="nav-link" href="#std_packaging_products" role="tab" data-toggle="tab">
                {{ trans('cruds.product.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="std_packaging_products">
            @includeIf('admin.packagings.relationships.stdPackagingProducts', ['products' => $packaging->stdPackagingProducts])
        </div>
    </div>
</div>

@endsection