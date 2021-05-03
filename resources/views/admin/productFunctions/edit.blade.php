@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.productFunction.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.product-functions.update", [$productFunction->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.productFunction.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $productFunction->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.productFunction.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.productFunction.fields.description') }}</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ old('description', $productFunction->description) }}</textarea>
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.productFunction.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="public_icon_url">{{ trans('cruds.productFunction.fields.public_icon_url') }}</label>
                <input class="form-control {{ $errors->has('public_icon_url') ? 'is-invalid' : '' }}" type="text" name="public_icon_url" id="public_icon_url" value="{{ old('public_icon_url', $productFunction->public_icon_url) }}">
                @if($errors->has('public_icon_url'))
                    <div class="invalid-feedback">
                        {{ $errors->first('public_icon_url') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.productFunction.fields.public_icon_url_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="list_order">{{ trans('cruds.productFunction.fields.list_order') }}</label>
                <input class="form-control {{ $errors->has('list_order') ? 'is-invalid' : '' }}" type="number" name="list_order" id="list_order" value="{{ old('list_order', $productFunction->list_order) }}" step="1">
                @if($errors->has('list_order'))
                    <div class="invalid-feedback">
                        {{ $errors->first('list_order') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.productFunction.fields.list_order_helper') }}</span>
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