@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.productSkuLetter.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.product-sku-letters.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="letter_code">{{ trans('cruds.productSkuLetter.fields.letter_code') }}</label>
                <input class="form-control {{ $errors->has('letter_code') ? 'is-invalid' : '' }}" type="text" name="letter_code" id="letter_code" value="{{ old('letter_code', '') }}" required>
                @if($errors->has('letter_code'))
                    <div class="invalid-feedback">
                        {{ $errors->first('letter_code') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.productSkuLetter.fields.letter_code_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="full_name">{{ trans('cruds.productSkuLetter.fields.full_name') }}</label>
                <input class="form-control {{ $errors->has('full_name') ? 'is-invalid' : '' }}" type="text" name="full_name" id="full_name" value="{{ old('full_name', '') }}" required>
                @if($errors->has('full_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('full_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.productSkuLetter.fields.full_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.productSkuLetter.fields.description') }}</label>
                <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" type="text" name="description" id="description" value="{{ old('description', '') }}">
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.productSkuLetter.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="sharepoint_url">{{ trans('cruds.productSkuLetter.fields.sharepoint_url') }}</label>
                <input class="form-control {{ $errors->has('sharepoint_url') ? 'is-invalid' : '' }}" type="text" name="sharepoint_url" id="sharepoint_url" value="{{ old('sharepoint_url', '') }}">
                @if($errors->has('sharepoint_url'))
                    <div class="invalid-feedback">
                        {{ $errors->first('sharepoint_url') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.productSkuLetter.fields.sharepoint_url_helper') }}</span>
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