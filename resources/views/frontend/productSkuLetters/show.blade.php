@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.productSkuLetter.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.product-sku-letters.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.productSkuLetter.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $productSkuLetter->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.productSkuLetter.fields.letter_code') }}
                                    </th>
                                    <td>
                                        {{ $productSkuLetter->letter_code }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.productSkuLetter.fields.full_name') }}
                                    </th>
                                    <td>
                                        {{ $productSkuLetter->full_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.productSkuLetter.fields.description') }}
                                    </th>
                                    <td>
                                        {{ $productSkuLetter->description }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.productSkuLetter.fields.sharepoint_url') }}
                                    </th>
                                    <td>
                                        {{ $productSkuLetter->sharepoint_url }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.product-sku-letters.index') }}">
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