@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.componentPart.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.component-parts.update", [$componentPart->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="product_sku_id">{{ trans('cruds.componentPart.fields.product_sku') }}</label>
                            <select class="form-control select2" name="product_sku_id" id="product_sku_id">
                                @foreach($product_skus as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('product_sku_id') ? old('product_sku_id') : $componentPart->product_sku->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('product_sku'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('product_sku') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.componentPart.fields.product_sku_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="component_part_name_id">{{ trans('cruds.componentPart.fields.component_part_name') }}</label>
                            <select class="form-control select2" name="component_part_name_id" id="component_part_name_id">
                                @foreach($component_part_names as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('component_part_name_id') ? old('component_part_name_id') : $componentPart->component_part_name->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('component_part_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('component_part_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.componentPart.fields.component_part_name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="quantity">{{ trans('cruds.componentPart.fields.quantity') }}</label>
                            <input class="form-control" type="number" name="quantity" id="quantity" value="{{ old('quantity', $componentPart->quantity) }}" step="1">
                            @if($errors->has('quantity'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('quantity') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.componentPart.fields.quantity_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="has_fabric_finish_choice" value="0">
                                <input type="checkbox" name="has_fabric_finish_choice" id="has_fabric_finish_choice" value="1" {{ $componentPart->has_fabric_finish_choice || old('has_fabric_finish_choice', 0) === 1 ? 'checked' : '' }}>
                                <label for="has_fabric_finish_choice">{{ trans('cruds.componentPart.fields.has_fabric_finish_choice') }}</label>
                            </div>
                            @if($errors->has('has_fabric_finish_choice'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('has_fabric_finish_choice') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.componentPart.fields.has_fabric_finish_choice_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="is_sub_assembly" value="0">
                                <input type="checkbox" name="is_sub_assembly" id="is_sub_assembly" value="1" {{ $componentPart->is_sub_assembly || old('is_sub_assembly', 0) === 1 ? 'checked' : '' }}>
                                <label for="is_sub_assembly">{{ trans('cruds.componentPart.fields.is_sub_assembly') }}</label>
                            </div>
                            @if($errors->has('is_sub_assembly'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('is_sub_assembly') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.componentPart.fields.is_sub_assembly_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="raw_material_id">{{ trans('cruds.componentPart.fields.raw_material') }}</label>
                            <select class="form-control select2" name="raw_material_id" id="raw_material_id">
                                @foreach($raw_materials as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('raw_material_id') ? old('raw_material_id') : $componentPart->raw_material->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('raw_material'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('raw_material') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.componentPart.fields.raw_material_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="length_mm">{{ trans('cruds.componentPart.fields.length_mm') }}</label>
                            <input class="form-control" type="number" name="length_mm" id="length_mm" value="{{ old('length_mm', $componentPart->length_mm) }}" step="1">
                            @if($errors->has('length_mm'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('length_mm') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.componentPart.fields.length_mm_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="width_mm">{{ trans('cruds.componentPart.fields.width_mm') }}</label>
                            <input class="form-control" type="number" name="width_mm" id="width_mm" value="{{ old('width_mm', $componentPart->width_mm) }}" step="1">
                            @if($errors->has('width_mm'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('width_mm') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.componentPart.fields.width_mm_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="height_mm">{{ trans('cruds.componentPart.fields.height_mm') }}</label>
                            <input class="form-control" type="text" name="height_mm" id="height_mm" value="{{ old('height_mm', $componentPart->height_mm) }}">
                            @if($errors->has('height_mm'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('height_mm') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.componentPart.fields.height_mm_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="weight_g">{{ trans('cruds.componentPart.fields.weight_g') }}</label>
                            <input class="form-control" type="number" name="weight_g" id="weight_g" value="{{ old('weight_g', $componentPart->weight_g) }}" step="1">
                            @if($errors->has('weight_g'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('weight_g') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.componentPart.fields.weight_g_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="primary_suppliers">{{ trans('cruds.componentPart.fields.primary_supplier') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="primary_suppliers[]" id="primary_suppliers" multiple>
                                @foreach($primary_suppliers as $id => $primary_supplier)
                                    <option value="{{ $id }}" {{ (in_array($id, old('primary_suppliers', [])) || $componentPart->primary_suppliers->contains($id)) ? 'selected' : '' }}>{{ $primary_supplier }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('primary_suppliers'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('primary_suppliers') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.componentPart.fields.primary_supplier_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="is_optional" value="0">
                                <input type="checkbox" name="is_optional" id="is_optional" value="1" {{ $componentPart->is_optional || old('is_optional', 0) === 1 ? 'checked' : '' }}>
                                <label for="is_optional">{{ trans('cruds.componentPart.fields.is_optional') }}</label>
                            </div>
                            @if($errors->has('is_optional'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('is_optional') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.componentPart.fields.is_optional_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="default_product_group_id">{{ trans('cruds.componentPart.fields.default_product_group') }}</label>
                            <select class="form-control select2" name="default_product_group_id" id="default_product_group_id">
                                @foreach($default_product_groups as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('default_product_group_id') ? old('default_product_group_id') : $componentPart->default_product_group->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('default_product_group'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('default_product_group') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.componentPart.fields.default_product_group_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection