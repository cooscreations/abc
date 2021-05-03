@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.productCodeGroup.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.product-code-groups.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.productCodeGroup.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $productCodeGroup->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.productCodeGroup.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $productCodeGroup->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.productCodeGroup.fields.description') }}
                                    </th>
                                    <td>
                                        {{ $productCodeGroup->description }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.productCodeGroup.fields.range_start') }}
                                    </th>
                                    <td>
                                        {{ $productCodeGroup->range_start }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.productCodeGroup.fields.range_end') }}
                                    </th>
                                    <td>
                                        {{ $productCodeGroup->range_end }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.productCodeGroup.fields.product_collection') }}
                                    </th>
                                    <td>
                                        @foreach($productCodeGroup->product_collections as $key => $product_collection)
                                            <span class="label label-info">{{ $product_collection->name }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.productCodeGroup.fields.product_function') }}
                                    </th>
                                    <td>
                                        @foreach($productCodeGroup->product_functions as $key => $product_function)
                                            <span class="label label-info">{{ $product_function->name }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.productCodeGroup.fields.product_type') }}
                                    </th>
                                    <td>
                                        @foreach($productCodeGroup->product_types as $key => $product_type)
                                            <span class="label label-info">{{ $product_type->name }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.productCodeGroup.fields.storage_options') }}
                                    </th>
                                    <td>
                                        @foreach($productCodeGroup->storage_options as $key => $storage_options)
                                            <span class="label label-info">{{ $storage_options->name }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.product-code-groups.index') }}">
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