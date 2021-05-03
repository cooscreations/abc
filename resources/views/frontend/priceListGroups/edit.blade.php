@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.priceListGroup.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.price-list-groups.update", [$priceListGroup->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="name">{{ trans('cruds.priceListGroup.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', $priceListGroup->name) }}">
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.priceListGroup.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="description">{{ trans('cruds.priceListGroup.fields.description') }}</label>
                            <input class="form-control" type="text" name="description" id="description" value="{{ old('description', $priceListGroup->description) }}">
                            @if($errors->has('description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('description') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.priceListGroup.fields.description_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="code">{{ trans('cruds.priceListGroup.fields.code') }}</label>
                            <input class="form-control" type="text" name="code" id="code" value="{{ old('code', $priceListGroup->code) }}">
                            @if($errors->has('code'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('code') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.priceListGroup.fields.code_helper') }}</span>
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