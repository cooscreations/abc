@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.productType.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.product-types.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.productType.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $productType->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.productType.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $productType->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.productType.fields.description') }}
                                    </th>
                                    <td>
                                        {{ $productType->description }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.productType.fields.public_url') }}
                                    </th>
                                    <td>
                                        {{ $productType->public_url }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.productType.fields.public_icon_url') }}
                                    </th>
                                    <td>
                                        {{ $productType->public_icon_url }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.productType.fields.list_order') }}
                                    </th>
                                    <td>
                                        {{ $productType->list_order }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.product-types.index') }}">
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