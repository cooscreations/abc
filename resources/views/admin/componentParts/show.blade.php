@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.componentPart.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.component-parts.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.componentPart.fields.id') }}
                        </th>
                        <td>
                            {{ $componentPart->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.componentPart.fields.product_sku') }}
                        </th>
                        <td>
                            {{ $componentPart->product_sku->product_sku ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.componentPart.fields.component_part_name') }}
                        </th>
                        <td>
                            {{ $componentPart->component_part_name->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.componentPart.fields.quantity') }}
                        </th>
                        <td>
                            {{ $componentPart->quantity }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.componentPart.fields.has_fabric_finish_choice') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $componentPart->has_fabric_finish_choice ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.componentPart.fields.is_sub_assembly') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $componentPart->is_sub_assembly ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.componentPart.fields.raw_material') }}
                        </th>
                        <td>
                            {{ $componentPart->raw_material->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.componentPart.fields.length_mm') }}
                        </th>
                        <td>
                            {{ $componentPart->length_mm }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.componentPart.fields.width_mm') }}
                        </th>
                        <td>
                            {{ $componentPart->width_mm }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.componentPart.fields.height_mm') }}
                        </th>
                        <td>
                            {{ $componentPart->height_mm }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.componentPart.fields.weight_g') }}
                        </th>
                        <td>
                            {{ $componentPart->weight_g }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.componentPart.fields.primary_supplier') }}
                        </th>
                        <td>
                            @foreach($componentPart->primary_suppliers as $key => $primary_supplier)
                                <span class="label label-info">{{ $primary_supplier->company_short_code }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.componentPart.fields.is_optional') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $componentPart->is_optional ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.componentPart.fields.default_product_group') }}
                        </th>
                        <td>
                            {{ $componentPart->default_product_group->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.component-parts.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection