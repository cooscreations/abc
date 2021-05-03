@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.afaStaff.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.afa-staffs.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="full_name">{{ trans('cruds.afaStaff.fields.full_name') }}</label>
                <input class="form-control {{ $errors->has('full_name') ? 'is-invalid' : '' }}" type="text" name="full_name" id="full_name" value="{{ old('full_name', '') }}">
                @if($errors->has('full_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('full_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.afaStaff.fields.full_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="user_id">{{ trans('cruds.afaStaff.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id">
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.afaStaff.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="staff_level_id">{{ trans('cruds.afaStaff.fields.staff_level') }}</label>
                <select class="form-control select2 {{ $errors->has('staff_level') ? 'is-invalid' : '' }}" name="staff_level_id" id="staff_level_id">
                    @foreach($staff_levels as $id => $entry)
                        <option value="{{ $id }}" {{ old('staff_level_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('staff_level'))
                    <div class="invalid-feedback">
                        {{ $errors->first('staff_level') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.afaStaff.fields.staff_level_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="reports_to_id">{{ trans('cruds.afaStaff.fields.reports_to') }}</label>
                <select class="form-control select2 {{ $errors->has('reports_to') ? 'is-invalid' : '' }}" name="reports_to_id" id="reports_to_id">
                    @foreach($reports_tos as $id => $entry)
                        <option value="{{ $id }}" {{ old('reports_to_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('reports_to'))
                    <div class="invalid-feedback">
                        {{ $errors->first('reports_to') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.afaStaff.fields.reports_to_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="date_started">{{ trans('cruds.afaStaff.fields.date_started') }}</label>
                <input class="form-control date {{ $errors->has('date_started') ? 'is-invalid' : '' }}" type="text" name="date_started" id="date_started" value="{{ old('date_started') }}">
                @if($errors->has('date_started'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date_started') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.afaStaff.fields.date_started_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="date_finished">{{ trans('cruds.afaStaff.fields.date_finished') }}</label>
                <input class="form-control date {{ $errors->has('date_finished') ? 'is-invalid' : '' }}" type="text" name="date_finished" id="date_finished" value="{{ old('date_finished') }}">
                @if($errors->has('date_finished'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date_finished') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.afaStaff.fields.date_finished_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="staff_bio">{{ trans('cruds.afaStaff.fields.staff_bio') }}</label>
                <textarea class="form-control {{ $errors->has('staff_bio') ? 'is-invalid' : '' }}" name="staff_bio" id="staff_bio">{{ old('staff_bio') }}</textarea>
                @if($errors->has('staff_bio'))
                    <div class="invalid-feedback">
                        {{ $errors->first('staff_bio') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.afaStaff.fields.staff_bio_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="department_id">{{ trans('cruds.afaStaff.fields.department') }}</label>
                <select class="form-control select2 {{ $errors->has('department') ? 'is-invalid' : '' }}" name="department_id" id="department_id" required>
                    @foreach($departments as $id => $entry)
                        <option value="{{ $id }}" {{ old('department_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('department'))
                    <div class="invalid-feedback">
                        {{ $errors->first('department') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.afaStaff.fields.department_helper') }}</span>
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