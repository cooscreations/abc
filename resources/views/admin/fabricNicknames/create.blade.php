@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.fabricNickname.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.fabric-nicknames.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.fabricNickname.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.fabricNickname.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="fabric_id">{{ trans('cruds.fabricNickname.fields.fabric') }}</label>
                <select class="form-control select2 {{ $errors->has('fabric') ? 'is-invalid' : '' }}" name="fabric_id" id="fabric_id" required>
                    @foreach($fabrics as $id => $entry)
                        <option value="{{ $id }}" {{ old('fabric_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('fabric'))
                    <div class="invalid-feedback">
                        {{ $errors->first('fabric') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.fabricNickname.fields.fabric_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="customer_id">{{ trans('cruds.fabricNickname.fields.customer') }}</label>
                <select class="form-control select2 {{ $errors->has('customer') ? 'is-invalid' : '' }}" name="customer_id" id="customer_id">
                    @foreach($customers as $id => $entry)
                        <option value="{{ $id }}" {{ old('customer_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('customer'))
                    <div class="invalid-feedback">
                        {{ $errors->first('customer') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.fabricNickname.fields.customer_helper') }}</span>
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