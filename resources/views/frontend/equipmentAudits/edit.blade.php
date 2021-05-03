@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.equipmentAudit.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.equipment-audits.update", [$equipmentAudit->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="equipment_id">{{ trans('cruds.equipmentAudit.fields.equipment') }}</label>
                            <select class="form-control select2" name="equipment_id" id="equipment_id">
                                @foreach($equipment as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('equipment_id') ? old('equipment_id') : $equipmentAudit->equipment->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('equipment'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('equipment') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.equipmentAudit.fields.equipment_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="company_id">{{ trans('cruds.equipmentAudit.fields.company') }}</label>
                            <select class="form-control select2" name="company_id" id="company_id">
                                @foreach($companies as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('company_id') ? old('company_id') : $equipmentAudit->company->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('company'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('company') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.equipmentAudit.fields.company_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="qty">{{ trans('cruds.equipmentAudit.fields.qty') }}</label>
                            <input class="form-control" type="number" name="qty" id="qty" value="{{ old('qty', $equipmentAudit->qty) }}" step="1">
                            @if($errors->has('qty'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('qty') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.equipmentAudit.fields.qty_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="location_id">{{ trans('cruds.equipmentAudit.fields.location') }}</label>
                            <select class="form-control select2" name="location_id" id="location_id">
                                @foreach($locations as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('location_id') ? old('location_id') : $equipmentAudit->location->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('location'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('location') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.equipmentAudit.fields.location_helper') }}</span>
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