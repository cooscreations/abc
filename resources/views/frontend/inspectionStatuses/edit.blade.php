@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.inspectionStatus.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.inspection-statuses.update", [$inspectionStatus->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="name">{{ trans('cruds.inspectionStatus.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', $inspectionStatus->name) }}" required>
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.inspectionStatus.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="list_order">{{ trans('cruds.inspectionStatus.fields.list_order') }}</label>
                            <input class="form-control" type="number" name="list_order" id="list_order" value="{{ old('list_order', $inspectionStatus->list_order) }}" step="1">
                            @if($errors->has('list_order'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('list_order') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.inspectionStatus.fields.list_order_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="status_color_hex">{{ trans('cruds.inspectionStatus.fields.status_color_hex') }}</label>
                            <input class="form-control" type="text" name="status_color_hex" id="status_color_hex" value="{{ old('status_color_hex', $inspectionStatus->status_color_hex) }}">
                            @if($errors->has('status_color_hex'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('status_color_hex') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.inspectionStatus.fields.status_color_hex_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="description">{{ trans('cruds.inspectionStatus.fields.description') }}</label>
                            <textarea class="form-control" name="description" id="description">{{ old('description', $inspectionStatus->description) }}</textarea>
                            @if($errors->has('description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('description') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.inspectionStatus.fields.description_helper') }}</span>
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