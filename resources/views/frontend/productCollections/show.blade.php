@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.productCollection.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.product-collections.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.productCollection.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $productCollection->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.productCollection.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $productCollection->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.productCollection.fields.public_logo_url') }}
                                    </th>
                                    <td>
                                        {{ $productCollection->public_logo_url }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.productCollection.fields.public_url') }}
                                    </th>
                                    <td>
                                        {{ $productCollection->public_url }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.productCollection.fields.share_point_url') }}
                                    </th>
                                    <td>
                                        {{ $productCollection->share_point_url }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.productCollection.fields.list_order') }}
                                    </th>
                                    <td>
                                        {{ $productCollection->list_order }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.product-collections.index') }}">
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