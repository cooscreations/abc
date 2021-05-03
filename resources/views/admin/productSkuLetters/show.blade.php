@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.productSkuLetter.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.product-sku-letters.index') }}">
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
                <a class="btn btn-default" href="{{ route('admin.product-sku-letters.index') }}">
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
            <a class="nav-link" href="#extra_letters_used_in_sku_products" role="tab" data-toggle="tab">
                {{ trans('cruds.product.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="extra_letters_used_in_sku_products">
            @includeIf('admin.productSkuLetters.relationships.extraLettersUsedInSkuProducts', ['products' => $productSkuLetter->extraLettersUsedInSkuProducts])
        </div>
    </div>
</div>

@endsection