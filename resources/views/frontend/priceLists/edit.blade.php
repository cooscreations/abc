@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.priceList.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.price-lists.update", [$priceList->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="name">{{ trans('cruds.priceList.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', $priceList->name) }}">
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.priceList.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="type_id">{{ trans('cruds.priceList.fields.type') }}</label>
                            <select class="form-control select2" name="type_id" id="type_id">
                                @foreach($types as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('type_id') ? old('type_id') : $priceList->type->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('type'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('type') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.priceList.fields.type_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="group_id">{{ trans('cruds.priceList.fields.group') }}</label>
                            <select class="form-control select2" name="group_id" id="group_id">
                                @foreach($groups as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('group_id') ? old('group_id') : $priceList->group->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('group'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('group') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.priceList.fields.group_helper') }}</span>
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