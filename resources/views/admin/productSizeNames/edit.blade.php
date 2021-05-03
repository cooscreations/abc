@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.productSizeName.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.product-size-names.update", [$productSizeName->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="name">{{ trans('cruds.productSizeName.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $productSizeName->name) }}">
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.productSizeName.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="code">{{ trans('cruds.productSizeName.fields.code') }}</label>
                <input class="form-control {{ $errors->has('code') ? 'is-invalid' : '' }}" type="text" name="code" id="code" value="{{ old('code', $productSizeName->code) }}">
                @if($errors->has('code'))
                    <div class="invalid-feedback">
                        {{ $errors->first('code') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.productSizeName.fields.code_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.productSizeName.fields.description') }}</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ old('description', $productSizeName->description) }}</textarea>
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.productSizeName.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="list_order">{{ trans('cruds.productSizeName.fields.list_order') }}</label>
                <input class="form-control {{ $errors->has('list_order') ? 'is-invalid' : '' }}" type="number" name="list_order" id="list_order" value="{{ old('list_order', $productSizeName->list_order) }}" step="1">
                @if($errors->has('list_order'))
                    <div class="invalid-feedback">
                        {{ $errors->first('list_order') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.productSizeName.fields.list_order_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection