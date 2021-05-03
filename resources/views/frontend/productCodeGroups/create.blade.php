@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.productCodeGroup.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.product-code-groups.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label for="name">{{ trans('cruds.productCodeGroup.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', '') }}">
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.productCodeGroup.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="description">{{ trans('cruds.productCodeGroup.fields.description') }}</label>
                            <textarea class="form-control" name="description" id="description">{{ old('description') }}</textarea>
                            @if($errors->has('description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('description') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.productCodeGroup.fields.description_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="range_start">{{ trans('cruds.productCodeGroup.fields.range_start') }}</label>
                            <input class="form-control" type="text" name="range_start" id="range_start" value="{{ old('range_start', '') }}">
                            @if($errors->has('range_start'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('range_start') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.productCodeGroup.fields.range_start_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="range_end">{{ trans('cruds.productCodeGroup.fields.range_end') }}</label>
                            <input class="form-control" type="text" name="range_end" id="range_end" value="{{ old('range_end', '') }}">
                            @if($errors->has('range_end'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('range_end') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.productCodeGroup.fields.range_end_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="product_collections">{{ trans('cruds.productCodeGroup.fields.product_collection') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="product_collections[]" id="product_collections" multiple>
                                @foreach($product_collections as $id => $product_collection)
                                    <option value="{{ $id }}" {{ in_array($id, old('product_collections', [])) ? 'selected' : '' }}>{{ $product_collection }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('product_collections'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('product_collections') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.productCodeGroup.fields.product_collection_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="product_functions">{{ trans('cruds.productCodeGroup.fields.product_function') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="product_functions[]" id="product_functions" multiple>
                                @foreach($product_functions as $id => $product_function)
                                    <option value="{{ $id }}" {{ in_array($id, old('product_functions', [])) ? 'selected' : '' }}>{{ $product_function }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('product_functions'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('product_functions') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.productCodeGroup.fields.product_function_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="product_types">{{ trans('cruds.productCodeGroup.fields.product_type') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="product_types[]" id="product_types" multiple>
                                @foreach($product_types as $id => $product_type)
                                    <option value="{{ $id }}" {{ in_array($id, old('product_types', [])) ? 'selected' : '' }}>{{ $product_type }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('product_types'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('product_types') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.productCodeGroup.fields.product_type_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="storage_options">{{ trans('cruds.productCodeGroup.fields.storage_options') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="storage_options[]" id="storage_options" multiple>
                                @foreach($storage_options as $id => $storage_options)
                                    <option value="{{ $id }}" {{ in_array($id, old('storage_options', [])) ? 'selected' : '' }}>{{ $storage_options }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('storage_options'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('storage_options') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.productCodeGroup.fields.storage_options_helper') }}</span>
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