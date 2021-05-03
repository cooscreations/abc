@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.productGroup.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.product-groups.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.productGroup.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $productGroup->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.productGroup.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $productGroup->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.productGroup.fields.description') }}
                                    </th>
                                    <td>
                                        {!! $productGroup->description !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.productGroup.fields.logo') }}
                                    </th>
                                    <td>
                                        @if($productGroup->logo)
                                            <a href="{{ $productGroup->logo->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $productGroup->logo->getUrl('thumb') }}">
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.productGroup.fields.public_url') }}
                                    </th>
                                    <td>
                                        {{ $productGroup->public_url }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.productGroup.fields.sharepoint_url') }}
                                    </th>
                                    <td>
                                        {{ $productGroup->sharepoint_url }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.productGroup.fields.public_logo_url') }}
                                    </th>
                                    <td>
                                        {{ $productGroup->public_logo_url }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.productGroup.fields.list_order') }}
                                    </th>
                                    <td>
                                        {{ $productGroup->list_order }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.product-groups.index') }}">
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