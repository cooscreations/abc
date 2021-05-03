@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.productDevelopmentStage.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.product-development-stages.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.productDevelopmentStage.fields.id') }}
                        </th>
                        <td>
                            {{ $productDevelopmentStage->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productDevelopmentStage.fields.name') }}
                        </th>
                        <td>
                            {{ $productDevelopmentStage->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productDevelopmentStage.fields.description') }}
                        </th>
                        <td>
                            {{ $productDevelopmentStage->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productDevelopmentStage.fields.list_order') }}
                        </th>
                        <td>
                            {{ $productDevelopmentStage->list_order }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.product-development-stages.index') }}">
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
            <a class="nav-link" href="#prod_dev_stage_product_skus" role="tab" data-toggle="tab">
                {{ trans('cruds.productSku.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="prod_dev_stage_product_skus">
            @includeIf('admin.productDevelopmentStages.relationships.prodDevStageProductSkus', ['productSkus' => $productDevelopmentStage->prodDevStageProductSkus])
        </div>
    </div>
</div>

@endsection