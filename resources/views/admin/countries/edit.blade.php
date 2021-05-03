@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.country.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.countries.update", [$country->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.country.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $country->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.country.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="short_code">{{ trans('cruds.country.fields.short_code') }}</label>
                <input class="form-control {{ $errors->has('short_code') ? 'is-invalid' : '' }}" type="text" name="short_code" id="short_code" value="{{ old('short_code', $country->short_code) }}" required>
                @if($errors->has('short_code'))
                    <div class="invalid-feedback">
                        {{ $errors->first('short_code') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.country.fields.short_code_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="alpha_2">{{ trans('cruds.country.fields.alpha_2') }}</label>
                <input class="form-control {{ $errors->has('alpha_2') ? 'is-invalid' : '' }}" type="text" name="alpha_2" id="alpha_2" value="{{ old('alpha_2', $country->alpha_2) }}" required>
                @if($errors->has('alpha_2'))
                    <div class="invalid-feedback">
                        {{ $errors->first('alpha_2') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.country.fields.alpha_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="alpha_3">{{ trans('cruds.country.fields.alpha_3') }}</label>
                <input class="form-control {{ $errors->has('alpha_3') ? 'is-invalid' : '' }}" type="text" name="alpha_3" id="alpha_3" value="{{ old('alpha_3', $country->alpha_3) }}">
                @if($errors->has('alpha_3'))
                    <div class="invalid-feedback">
                        {{ $errors->first('alpha_3') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.country.fields.alpha_3_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="world_region_id">{{ trans('cruds.country.fields.world_region') }}</label>
                <select class="form-control select2 {{ $errors->has('world_region') ? 'is-invalid' : '' }}" name="world_region_id" id="world_region_id">
                    @foreach($world_regions as $id => $entry)
                        <option value="{{ $id }}" {{ (old('world_region_id') ? old('world_region_id') : $country->world_region->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('world_region'))
                    <div class="invalid-feedback">
                        {{ $errors->first('world_region') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.country.fields.world_region_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="notes">{{ trans('cruds.country.fields.notes') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('notes') ? 'is-invalid' : '' }}" name="notes" id="notes">{!! old('notes', $country->notes) !!}</textarea>
                @if($errors->has('notes'))
                    <div class="invalid-feedback">
                        {{ $errors->first('notes') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.country.fields.notes_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="wiki_url">{{ trans('cruds.country.fields.wiki_url') }}</label>
                <input class="form-control {{ $errors->has('wiki_url') ? 'is-invalid' : '' }}" type="text" name="wiki_url" id="wiki_url" value="{{ old('wiki_url', $country->wiki_url) }}">
                @if($errors->has('wiki_url'))
                    <div class="invalid-feedback">
                        {{ $errors->first('wiki_url') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.country.fields.wiki_url_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="default_currency_id">{{ trans('cruds.country.fields.default_currency') }}</label>
                <select class="form-control select2 {{ $errors->has('default_currency') ? 'is-invalid' : '' }}" name="default_currency_id" id="default_currency_id">
                    @foreach($default_currencies as $id => $entry)
                        <option value="{{ $id }}" {{ (old('default_currency_id') ? old('default_currency_id') : $country->default_currency->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('default_currency'))
                    <div class="invalid-feedback">
                        {{ $errors->first('default_currency') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.country.fields.default_currency_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="iso_number">{{ trans('cruds.country.fields.iso_number') }}</label>
                <input class="form-control {{ $errors->has('iso_number') ? 'is-invalid' : '' }}" type="text" name="iso_number" id="iso_number" value="{{ old('iso_number', $country->iso_number) }}">
                @if($errors->has('iso_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('iso_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.country.fields.iso_number_helper') }}</span>
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

@section('scripts')
<script>
    $(document).ready(function () {
  function SimpleUploadAdapter(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
      return {
        upload: function() {
          return loader.file
            .then(function (file) {
              return new Promise(function(resolve, reject) {
                // Init request
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '{{ route('admin.countries.storeCKEditorImages') }}', true);
                xhr.setRequestHeader('x-csrf-token', window._token);
                xhr.setRequestHeader('Accept', 'application/json');
                xhr.responseType = 'json';

                // Init listeners
                var genericErrorText = `Couldn't upload file: ${ file.name }.`;
                xhr.addEventListener('error', function() { reject(genericErrorText) });
                xhr.addEventListener('abort', function() { reject() });
                xhr.addEventListener('load', function() {
                  var response = xhr.response;

                  if (!response || xhr.status !== 201) {
                    return reject(response && response.message ? `${genericErrorText}\n${xhr.status} ${response.message}` : `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`);
                  }

                  $('form').append('<input type="hidden" name="ck-media[]" value="' + response.id + '">');

                  resolve({ default: response.url });
                });

                if (xhr.upload) {
                  xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                      loader.uploadTotal = e.total;
                      loader.uploaded = e.loaded;
                    }
                  });
                }

                // Send request
                var data = new FormData();
                data.append('upload', file);
                data.append('crud_id', '{{ $country->id ?? 0 }}');
                xhr.send(data);
              });
            })
        }
      };
    }
  }

  var allEditors = document.querySelectorAll('.ckeditor');
  for (var i = 0; i < allEditors.length; ++i) {
    ClassicEditor.create(
      allEditors[i], {
        extraPlugins: [SimpleUploadAdapter]
      }
    );
  }
});
</script>

@endsection