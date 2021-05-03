@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.price.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.prices.update", [$price->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="sku_id">{{ trans('cruds.price.fields.sku') }}</label>
                            <select class="form-control select2" name="sku_id" id="sku_id" required>
                                @foreach($skus as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('sku_id') ? old('sku_id') : $price->sku->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('sku'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('sku') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.price.fields.sku_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="default_raw_material_id">{{ trans('cruds.price.fields.default_raw_material') }}</label>
                            <select class="form-control select2" name="default_raw_material_id" id="default_raw_material_id">
                                @foreach($default_raw_materials as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('default_raw_material_id') ? old('default_raw_material_id') : $price->default_raw_material->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('default_raw_material'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('default_raw_material') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.price.fields.default_raw_material_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="price_list_id">{{ trans('cruds.price.fields.price_list') }}</label>
                            <select class="form-control select2" name="price_list_id" id="price_list_id">
                                @foreach($price_lists as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('price_list_id') ? old('price_list_id') : $price->price_list->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('price_list'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('price_list') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.price.fields.price_list_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="description">{{ trans('cruds.price.fields.description') }}</label>
                            <textarea class="form-control" name="description" id="description">{{ old('description', $price->description) }}</textarea>
                            @if($errors->has('description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('description') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.price.fields.description_helper') }}</span>
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