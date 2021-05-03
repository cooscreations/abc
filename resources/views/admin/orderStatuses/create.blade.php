@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.orderStatus.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.order-statuses.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">{{ trans('cruds.orderStatus.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}">
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.orderStatus.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.orderStatus.fields.description') }}</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ old('description') }}</textarea>
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.orderStatus.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="list_order">{{ trans('cruds.orderStatus.fields.list_order') }}</label>
                <input class="form-control {{ $errors->has('list_order') ? 'is-invalid' : '' }}" type="number" name="list_order" id="list_order" value="{{ old('list_order', '') }}" step="1" required>
                @if($errors->has('list_order'))
                    <div class="invalid-feedback">
                        {{ $errors->first('list_order') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.orderStatus.fields.list_order_helper') }}</span>
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