@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.contactCompany.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.contact-companies.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="company_short_code">{{ trans('cruds.contactCompany.fields.company_short_code') }}</label>
                <input class="form-control {{ $errors->has('company_short_code') ? 'is-invalid' : '' }}" type="text" name="company_short_code" id="company_short_code" value="{{ old('company_short_code', '') }}">
                @if($errors->has('company_short_code'))
                    <div class="invalid-feedback">
                        {{ $errors->first('company_short_code') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contactCompany.fields.company_short_code_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="company_name">{{ trans('cruds.contactCompany.fields.company_name') }}</label>
                <input class="form-control {{ $errors->has('company_name') ? 'is-invalid' : '' }}" type="text" name="company_name" id="company_name" value="{{ old('company_name', '') }}">
                @if($errors->has('company_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('company_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contactCompany.fields.company_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="parent_company_id">{{ trans('cruds.contactCompany.fields.parent_company') }}</label>
                <select class="form-control select2 {{ $errors->has('parent_company') ? 'is-invalid' : '' }}" name="parent_company_id" id="parent_company_id">
                    @foreach($parent_companies as $id => $entry)
                        <option value="{{ $id }}" {{ old('parent_company_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('parent_company'))
                    <div class="invalid-feedback">
                        {{ $errors->first('parent_company') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contactCompany.fields.parent_company_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="company_website">{{ trans('cruds.contactCompany.fields.company_website') }}</label>
                <input class="form-control {{ $errors->has('company_website') ? 'is-invalid' : '' }}" type="text" name="company_website" id="company_website" value="{{ old('company_website', '') }}">
                @if($errors->has('company_website'))
                    <div class="invalid-feedback">
                        {{ $errors->first('company_website') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contactCompany.fields.company_website_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="company_email">{{ trans('cruds.contactCompany.fields.company_email') }}</label>
                <input class="form-control {{ $errors->has('company_email') ? 'is-invalid' : '' }}" type="text" name="company_email" id="company_email" value="{{ old('company_email', '') }}">
                @if($errors->has('company_email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('company_email') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contactCompany.fields.company_email_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="primary_company_type_id">{{ trans('cruds.contactCompany.fields.primary_company_type') }}</label>
                <select class="form-control select2 {{ $errors->has('primary_company_type') ? 'is-invalid' : '' }}" name="primary_company_type_id" id="primary_company_type_id" required>
                    @foreach($primary_company_types as $id => $entry)
                        <option value="{{ $id }}" {{ old('primary_company_type_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('primary_company_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('primary_company_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contactCompany.fields.primary_company_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="reg_country_id">{{ trans('cruds.contactCompany.fields.reg_country') }}</label>
                <select class="form-control select2 {{ $errors->has('reg_country') ? 'is-invalid' : '' }}" name="reg_country_id" id="reg_country_id" required>
                    @foreach($reg_countries as $id => $entry)
                        <option value="{{ $id }}" {{ old('reg_country_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('reg_country'))
                    <div class="invalid-feedback">
                        {{ $errors->first('reg_country') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contactCompany.fields.reg_country_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="formal_reg_name">{{ trans('cruds.contactCompany.fields.formal_reg_name') }}</label>
                <input class="form-control {{ $errors->has('formal_reg_name') ? 'is-invalid' : '' }}" type="text" name="formal_reg_name" id="formal_reg_name" value="{{ old('formal_reg_name', '') }}">
                @if($errors->has('formal_reg_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('formal_reg_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contactCompany.fields.formal_reg_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="local_name">{{ trans('cruds.contactCompany.fields.local_name') }}</label>
                <input class="form-control {{ $errors->has('local_name') ? 'is-invalid' : '' }}" type="text" name="local_name" id="local_name" value="{{ old('local_name', '') }}">
                @if($errors->has('local_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('local_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contactCompany.fields.local_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="company_reg_date">{{ trans('cruds.contactCompany.fields.company_reg_date') }}</label>
                <input class="form-control date {{ $errors->has('company_reg_date') ? 'is-invalid' : '' }}" type="text" name="company_reg_date" id="company_reg_date" value="{{ old('company_reg_date') }}">
                @if($errors->has('company_reg_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('company_reg_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contactCompany.fields.company_reg_date_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('has_english_speaking_staff') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="has_english_speaking_staff" value="0">
                    <input class="form-check-input" type="checkbox" name="has_english_speaking_staff" id="has_english_speaking_staff" value="1" {{ old('has_english_speaking_staff', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="has_english_speaking_staff">{{ trans('cruds.contactCompany.fields.has_english_speaking_staff') }}</label>
                </div>
                @if($errors->has('has_english_speaking_staff'))
                    <div class="invalid-feedback">
                        {{ $errors->first('has_english_speaking_staff') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contactCompany.fields.has_english_speaking_staff_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="owner_contact_id">{{ trans('cruds.contactCompany.fields.owner_contact') }}</label>
                <select class="form-control select2 {{ $errors->has('owner_contact') ? 'is-invalid' : '' }}" name="owner_contact_id" id="owner_contact_id">
                    @foreach($owner_contacts as $id => $entry)
                        <option value="{{ $id }}" {{ old('owner_contact_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('owner_contact'))
                    <div class="invalid-feedback">
                        {{ $errors->first('owner_contact') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contactCompany.fields.owner_contact_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="ownership_type_id">{{ trans('cruds.contactCompany.fields.ownership_type') }}</label>
                <select class="form-control select2 {{ $errors->has('ownership_type') ? 'is-invalid' : '' }}" name="ownership_type_id" id="ownership_type_id">
                    @foreach($ownership_types as $id => $entry)
                        <option value="{{ $id }}" {{ old('ownership_type_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('ownership_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ownership_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contactCompany.fields.ownership_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="company_reg_num">{{ trans('cruds.contactCompany.fields.company_reg_num') }}</label>
                <input class="form-control {{ $errors->has('company_reg_num') ? 'is-invalid' : '' }}" type="text" name="company_reg_num" id="company_reg_num" value="{{ old('company_reg_num', '') }}">
                @if($errors->has('company_reg_num'))
                    <div class="invalid-feedback">
                        {{ $errors->first('company_reg_num') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contactCompany.fields.company_reg_num_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="company_reg_expiry">{{ trans('cruds.contactCompany.fields.company_reg_expiry') }}</label>
                <input class="form-control date {{ $errors->has('company_reg_expiry') ? 'is-invalid' : '' }}" type="text" name="company_reg_expiry" id="company_reg_expiry" value="{{ old('company_reg_expiry') }}">
                @if($errors->has('company_reg_expiry'))
                    <div class="invalid-feedback">
                        {{ $errors->first('company_reg_expiry') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contactCompany.fields.company_reg_expiry_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="export_license_num">{{ trans('cruds.contactCompany.fields.export_license_num') }}</label>
                <input class="form-control {{ $errors->has('export_license_num') ? 'is-invalid' : '' }}" type="text" name="export_license_num" id="export_license_num" value="{{ old('export_license_num', '') }}">
                @if($errors->has('export_license_num'))
                    <div class="invalid-feedback">
                        {{ $errors->first('export_license_num') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contactCompany.fields.export_license_num_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="import_license_num">{{ trans('cruds.contactCompany.fields.import_license_num') }}</label>
                <input class="form-control {{ $errors->has('import_license_num') ? 'is-invalid' : '' }}" type="text" name="import_license_num" id="import_license_num" value="{{ old('import_license_num', '') }}">
                @if($errors->has('import_license_num'))
                    <div class="invalid-feedback">
                        {{ $errors->first('import_license_num') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contactCompany.fields.import_license_num_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('social_9001') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="social_9001" value="0">
                    <input class="form-check-input" type="checkbox" name="social_9001" id="social_9001" value="1" {{ old('social_9001', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="social_9001">{{ trans('cruds.contactCompany.fields.social_9001') }}</label>
                </div>
                @if($errors->has('social_9001'))
                    <div class="invalid-feedback">
                        {{ $errors->first('social_9001') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contactCompany.fields.social_9001_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('production_9001') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="production_9001" value="0">
                    <input class="form-check-input" type="checkbox" name="production_9001" id="production_9001" value="1" {{ old('production_9001', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="production_9001">{{ trans('cruds.contactCompany.fields.production_9001') }}</label>
                </div>
                @if($errors->has('production_9001'))
                    <div class="invalid-feedback">
                        {{ $errors->first('production_9001') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contactCompany.fields.production_9001_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('anti_slavery_policy') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="anti_slavery_policy" value="0">
                    <input class="form-check-input" type="checkbox" name="anti_slavery_policy" id="anti_slavery_policy" value="1" {{ old('anti_slavery_policy', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="anti_slavery_policy">{{ trans('cruds.contactCompany.fields.anti_slavery_policy') }}</label>
                </div>
                @if($errors->has('anti_slavery_policy'))
                    <div class="invalid-feedback">
                        {{ $errors->first('anti_slavery_policy') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contactCompany.fields.anti_slavery_policy_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('bsci_certified') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="bsci_certified" value="0">
                    <input class="form-check-input" type="checkbox" name="bsci_certified" id="bsci_certified" value="1" {{ old('bsci_certified', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="bsci_certified">{{ trans('cruds.contactCompany.fields.bsci_certified') }}</label>
                </div>
                @if($errors->has('bsci_certified'))
                    <div class="invalid-feedback">
                        {{ $errors->first('bsci_certified') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contactCompany.fields.bsci_certified_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="primary_language_id">{{ trans('cruds.contactCompany.fields.primary_language') }}</label>
                <select class="form-control select2 {{ $errors->has('primary_language') ? 'is-invalid' : '' }}" name="primary_language_id" id="primary_language_id">
                    @foreach($primary_languages as $id => $entry)
                        <option value="{{ $id }}" {{ old('primary_language_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('primary_language'))
                    <div class="invalid-feedback">
                        {{ $errors->first('primary_language') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contactCompany.fields.primary_language_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="addresses">{{ trans('cruds.contactCompany.fields.addresses') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('addresses') ? 'is-invalid' : '' }}" name="addresses[]" id="addresses" multiple>
                    @foreach($addresses as $id => $addresses)
                        <option value="{{ $id }}" {{ in_array($id, old('addresses', [])) ? 'selected' : '' }}>{{ $addresses }}</option>
                    @endforeach
                </select>
                @if($errors->has('addresses'))
                    <div class="invalid-feedback">
                        {{ $errors->first('addresses') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contactCompany.fields.addresses_helper') }}</span>
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