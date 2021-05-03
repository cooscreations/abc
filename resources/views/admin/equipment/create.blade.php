@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.equipment.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.equipment.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">{{ trans('cruds.equipment.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}">
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.equipment.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.equipment.fields.description') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{!! old('description') !!}</textarea>
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.equipment.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="public_url">{{ trans('cruds.equipment.fields.public_url') }}</label>
                <input class="form-control {{ $errors->has('public_url') ? 'is-invalid' : '' }}" type="text" name="public_url" id="public_url" value="{{ old('public_url', '') }}">
                @if($errors->has('public_url'))
                    <div class="invalid-feedback">
                        {{ $errors->first('public_url') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.equipment.fields.public_url_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="manufacturer_id">{{ trans('cruds.equipment.fields.manufacturer') }}</label>
                <select class="form-control select2 {{ $errors->has('manufacturer') ? 'is-invalid' : '' }}" name="manufacturer_id" id="manufacturer_id">
                    @foreach($manufacturers as $id => $entry)
                        <option value="{{ $id }}" {{ old('manufacturer_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('manufacturer'))
                    <div class="invalid-feedback">
                        {{ $errors->first('manufacturer') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.equipment.fields.manufacturer_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="equipment_type_id">{{ trans('cruds.equipment.fields.equipment_type') }}</label>
                <select class="form-control select2 {{ $errors->has('equipment_type') ? 'is-invalid' : '' }}" name="equipment_type_id" id="equipment_type_id">
                    @foreach($equipment_types as $id => $entry)
                        <option value="{{ $id }}" {{ old('equipment_type_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('equipment_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('equipment_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.equipment.fields.equipment_type_helper') }}</span>
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
                xhr.open('POST', '{{ route('admin.equipment.storeCKEditorImages') }}', true);
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
                data.append('crud_id', '{{ $equipment->id ?? 0 }}');
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