@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.productCollection.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.product-collections.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label for="name">{{ trans('cruds.productCollection.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', '') }}">
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.productCollection.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="public_logo_url">{{ trans('cruds.productCollection.fields.public_logo_url') }}</label>
                            <input class="form-control" type="text" name="public_logo_url" id="public_logo_url" value="{{ old('public_logo_url', '') }}">
                            @if($errors->has('public_logo_url'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('public_logo_url') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.productCollection.fields.public_logo_url_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="public_url">{{ trans('cruds.productCollection.fields.public_url') }}</label>
                            <input class="form-control" type="text" name="public_url" id="public_url" value="{{ old('public_url', '') }}">
                            @if($errors->has('public_url'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('public_url') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.productCollection.fields.public_url_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="share_point_url">{{ trans('cruds.productCollection.fields.share_point_url') }}</label>
                            <input class="form-control" type="text" name="share_point_url" id="share_point_url" value="{{ old('share_point_url', '') }}">
                            @if($errors->has('share_point_url'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('share_point_url') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.productCollection.fields.share_point_url_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="list_order">{{ trans('cruds.productCollection.fields.list_order') }}</label>
                            <input class="form-control" type="number" name="list_order" id="list_order" value="{{ old('list_order', '') }}" step="1">
                            @if($errors->has('list_order'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('list_order') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.productCollection.fields.list_order_helper') }}</span>
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