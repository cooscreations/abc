@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.contactContact.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.contact-contacts.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label for="user_id">{{ trans('cruds.contactContact.fields.user') }}</label>
                            <select class="form-control select2" name="user_id" id="user_id">
                                @foreach($users as $id => $entry)
                                    <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('user'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('user') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.contactContact.fields.user_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="title">{{ trans('cruds.contactContact.fields.title') }}</label>
                            <input class="form-control" type="text" name="title" id="title" value="{{ old('title', '') }}">
                            @if($errors->has('title'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('title') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.contactContact.fields.title_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="contact_first_name">{{ trans('cruds.contactContact.fields.contact_first_name') }}</label>
                            <input class="form-control" type="text" name="contact_first_name" id="contact_first_name" value="{{ old('contact_first_name', '') }}">
                            @if($errors->has('contact_first_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('contact_first_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.contactContact.fields.contact_first_name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="contact_last_name">{{ trans('cruds.contactContact.fields.contact_last_name') }}</label>
                            <input class="form-control" type="text" name="contact_last_name" id="contact_last_name" value="{{ old('contact_last_name', '') }}">
                            @if($errors->has('contact_last_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('contact_last_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.contactContact.fields.contact_last_name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="full_name">{{ trans('cruds.contactContact.fields.full_name') }}</label>
                            <input class="form-control" type="text" name="full_name" id="full_name" value="{{ old('full_name', '') }}">
                            @if($errors->has('full_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('full_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.contactContact.fields.full_name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="local_name">{{ trans('cruds.contactContact.fields.local_name') }}</label>
                            <input class="form-control" type="text" name="local_name" id="local_name" value="{{ old('local_name', '') }}">
                            @if($errors->has('local_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('local_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.contactContact.fields.local_name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="country_of_birth_id">{{ trans('cruds.contactContact.fields.country_of_birth') }}</label>
                            <select class="form-control select2" name="country_of_birth_id" id="country_of_birth_id">
                                @foreach($country_of_births as $id => $entry)
                                    <option value="{{ $id }}" {{ old('country_of_birth_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('country_of_birth'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('country_of_birth') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.contactContact.fields.country_of_birth_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="primary_address_id">{{ trans('cruds.contactContact.fields.primary_address') }}</label>
                            <select class="form-control select2" name="primary_address_id" id="primary_address_id">
                                @foreach($primary_addresses as $id => $entry)
                                    <option value="{{ $id }}" {{ old('primary_address_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('primary_address'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('primary_address') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.contactContact.fields.primary_address_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="current_country_id">{{ trans('cruds.contactContact.fields.current_country') }}</label>
                            <select class="form-control select2" name="current_country_id" id="current_country_id">
                                @foreach($current_countries as $id => $entry)
                                    <option value="{{ $id }}" {{ old('current_country_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('current_country'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('current_country') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.contactContact.fields.current_country_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="company_id">{{ trans('cruds.contactContact.fields.company') }}</label>
                            <select class="form-control select2" name="company_id" id="company_id" required>
                                @foreach($companies as $id => $entry)
                                    <option value="{{ $id }}" {{ old('company_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('company'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('company') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.contactContact.fields.company_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="photo">{{ trans('cruds.contactContact.fields.photo') }}</label>
                            <div class="needsclick dropzone" id="photo-dropzone">
                            </div>
                            @if($errors->has('photo'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('photo') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.contactContact.fields.photo_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="wechat">{{ trans('cruds.contactContact.fields.wechat') }}</label>
                            <input class="form-control" type="text" name="wechat" id="wechat" value="{{ old('wechat', '') }}">
                            @if($errors->has('wechat'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('wechat') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.contactContact.fields.wechat_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="linkedin_url">{{ trans('cruds.contactContact.fields.linkedin_url') }}</label>
                            <input class="form-control" type="text" name="linkedin_url" id="linkedin_url" value="{{ old('linkedin_url', '') }}">
                            @if($errors->has('linkedin_url'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('linkedin_url') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.contactContact.fields.linkedin_url_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="facebook_url">{{ trans('cruds.contactContact.fields.facebook_url') }}</label>
                            <input class="form-control" type="text" name="facebook_url" id="facebook_url" value="{{ old('facebook_url', '') }}">
                            @if($errors->has('facebook_url'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('facebook_url') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.contactContact.fields.facebook_url_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="contact_email">{{ trans('cruds.contactContact.fields.contact_email') }}</label>
                            <input class="form-control" type="text" name="contact_email" id="contact_email" value="{{ old('contact_email', '') }}">
                            @if($errors->has('contact_email'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('contact_email') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.contactContact.fields.contact_email_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="personal_email">{{ trans('cruds.contactContact.fields.personal_email') }}</label>
                            <input class="form-control" type="text" name="personal_email" id="personal_email" value="{{ old('personal_email', '') }}">
                            @if($errors->has('personal_email'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('personal_email') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.contactContact.fields.personal_email_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="office_phone">{{ trans('cruds.contactContact.fields.office_phone') }}</label>
                            <input class="form-control" type="text" name="office_phone" id="office_phone" value="{{ old('office_phone', '') }}">
                            @if($errors->has('office_phone'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('office_phone') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.contactContact.fields.office_phone_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="mobile_phone">{{ trans('cruds.contactContact.fields.mobile_phone') }}</label>
                            <input class="form-control" type="text" name="mobile_phone" id="mobile_phone" value="{{ old('mobile_phone', '') }}">
                            @if($errors->has('mobile_phone'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('mobile_phone') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.contactContact.fields.mobile_phone_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="personal_url">{{ trans('cruds.contactContact.fields.personal_url') }}</label>
                            <input class="form-control" type="text" name="personal_url" id="personal_url" value="{{ old('personal_url', '') }}">
                            @if($errors->has('personal_url'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('personal_url') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.contactContact.fields.personal_url_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="date_of_birth">{{ trans('cruds.contactContact.fields.date_of_birth') }}</label>
                            <input class="form-control date" type="text" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth') }}">
                            @if($errors->has('date_of_birth'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('date_of_birth') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.contactContact.fields.date_of_birth_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="business_card">{{ trans('cruds.contactContact.fields.business_card') }}</label>
                            <div class="needsclick dropzone" id="business_card-dropzone">
                            </div>
                            @if($errors->has('business_card'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('business_card') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.contactContact.fields.business_card_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="qr_code">{{ trans('cruds.contactContact.fields.qr_code') }}</label>
                            <div class="needsclick dropzone" id="qr_code-dropzone">
                            </div>
                            @if($errors->has('qr_code'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('qr_code') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.contactContact.fields.qr_code_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="default_language_id">{{ trans('cruds.contactContact.fields.default_language') }}</label>
                            <select class="form-control select2" name="default_language_id" id="default_language_id">
                                @foreach($default_languages as $id => $entry)
                                    <option value="{{ $id }}" {{ old('default_language_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('default_language'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('default_language') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.contactContact.fields.default_language_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="roles">{{ trans('cruds.contactContact.fields.roles') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="roles[]" id="roles" multiple>
                                @foreach($roles as $id => $roles)
                                    <option value="{{ $id }}" {{ in_array($id, old('roles', [])) ? 'selected' : '' }}>{{ $roles }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('roles'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('roles') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.contactContact.fields.roles_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="nda_signed_date">{{ trans('cruds.contactContact.fields.nda_signed_date') }}</label>
                            <input class="form-control date" type="text" name="nda_signed_date" id="nda_signed_date" value="{{ old('nda_signed_date') }}">
                            @if($errors->has('nda_signed_date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('nda_signed_date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.contactContact.fields.nda_signed_date_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="honesty_agreement_signed_date">{{ trans('cruds.contactContact.fields.honesty_agreement_signed_date') }}</label>
                            <input class="form-control date" type="text" name="honesty_agreement_signed_date" id="honesty_agreement_signed_date" value="{{ old('honesty_agreement_signed_date') }}">
                            @if($errors->has('honesty_agreement_signed_date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('honesty_agreement_signed_date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.contactContact.fields.honesty_agreement_signed_date_helper') }}</span>
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

@section('scripts')
<script>
    Dropzone.options.photoDropzone = {
    url: '{{ route('frontend.contact-contacts.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="photo"]').remove()
      $('form').append('<input type="hidden" name="photo" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="photo"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($contactContact) && $contactContact->photo)
      var file = {!! json_encode($contactContact->photo) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="photo" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}
</script>
<script>
    var uploadedBusinessCardMap = {}
Dropzone.options.businessCardDropzone = {
    url: '{{ route('frontend.contact-contacts.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="business_card[]" value="' + response.name + '">')
      uploadedBusinessCardMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedBusinessCardMap[file.name]
      }
      $('form').find('input[name="business_card[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($contactContact) && $contactContact->business_card)
      var files = {!! json_encode($contactContact->business_card) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="business_card[]" value="' + file.file_name + '">')
        }
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
<script>
    Dropzone.options.qrCodeDropzone = {
    url: '{{ route('frontend.contact-contacts.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="qr_code"]').remove()
      $('form').append('<input type="hidden" name="qr_code" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="qr_code"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($contactContact) && $contactContact->qr_code)
      var file = {!! json_encode($contactContact->qr_code) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="qr_code" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}
</script>
@endsection