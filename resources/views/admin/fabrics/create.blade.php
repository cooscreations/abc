@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.fabric.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.fabrics.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.fabric.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.fabric.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="fabric_group_id">{{ trans('cruds.fabric.fields.fabric_group') }}</label>
                <select class="form-control select2 {{ $errors->has('fabric_group') ? 'is-invalid' : '' }}" name="fabric_group_id" id="fabric_group_id" required>
                    @foreach($fabric_groups as $id => $entry)
                        <option value="{{ $id }}" {{ old('fabric_group_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('fabric_group'))
                    <div class="invalid-feedback">
                        {{ $errors->first('fabric_group') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.fabric.fields.fabric_group_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="fabric_code">{{ trans('cruds.fabric.fields.fabric_code') }}</label>
                <input class="form-control {{ $errors->has('fabric_code') ? 'is-invalid' : '' }}" type="text" name="fabric_code" id="fabric_code" value="{{ old('fabric_code', '') }}">
                @if($errors->has('fabric_code'))
                    <div class="invalid-feedback">
                        {{ $errors->first('fabric_code') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.fabric.fields.fabric_code_helper') }}</span>
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