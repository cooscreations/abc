@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.staffLevel.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.staff-levels.update", [$staffLevel->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="name">{{ trans('cruds.staffLevel.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', $staffLevel->name) }}">
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.staffLevel.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="list_order">{{ trans('cruds.staffLevel.fields.list_order') }}</label>
                            <input class="form-control" type="text" name="list_order" id="list_order" value="{{ old('list_order', $staffLevel->list_order) }}">
                            @if($errors->has('list_order'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('list_order') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.staffLevel.fields.list_order_helper') }}</span>
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