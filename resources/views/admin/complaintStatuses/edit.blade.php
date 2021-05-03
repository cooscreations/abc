@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.complaintStatus.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.complaint-statuses.update", [$complaintStatus->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="name">{{ trans('cruds.complaintStatus.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $complaintStatus->name) }}">
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.complaintStatus.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.complaintStatus.fields.description') }}</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ old('description', $complaintStatus->description) }}</textarea>
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.complaintStatus.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="list_order">{{ trans('cruds.complaintStatus.fields.list_order') }}</label>
                <input class="form-control {{ $errors->has('list_order') ? 'is-invalid' : '' }}" type="number" name="list_order" id="list_order" value="{{ old('list_order', $complaintStatus->list_order) }}" step="1">
                @if($errors->has('list_order'))
                    <div class="invalid-feedback">
                        {{ $errors->first('list_order') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.complaintStatus.fields.list_order_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="color_code">{{ trans('cruds.complaintStatus.fields.color_code') }}</label>
                <input class="form-control {{ $errors->has('color_code') ? 'is-invalid' : '' }}" type="text" name="color_code" id="color_code" value="{{ old('color_code', $complaintStatus->color_code) }}">
                @if($errors->has('color_code'))
                    <div class="invalid-feedback">
                        {{ $errors->first('color_code') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.complaintStatus.fields.color_code_helper') }}</span>
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