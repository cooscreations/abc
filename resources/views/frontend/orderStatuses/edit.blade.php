@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.orderStatus.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.order-statuses.update", [$orderStatus->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="name">{{ trans('cruds.orderStatus.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', $orderStatus->name) }}">
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.orderStatus.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="description">{{ trans('cruds.orderStatus.fields.description') }}</label>
                            <textarea class="form-control" name="description" id="description">{{ old('description', $orderStatus->description) }}</textarea>
                            @if($errors->has('description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('description') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.orderStatus.fields.description_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="list_order">{{ trans('cruds.orderStatus.fields.list_order') }}</label>
                            <input class="form-control" type="number" name="list_order" id="list_order" value="{{ old('list_order', $orderStatus->list_order) }}" step="1" required>
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

        </div>
    </div>
</div>
@endsection