@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.rawMaterial.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.raw-materials.update", [$rawMaterial->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="name">{{ trans('cruds.rawMaterial.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $rawMaterial->name) }}">
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.rawMaterial.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="notes">{{ trans('cruds.rawMaterial.fields.notes') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('notes') ? 'is-invalid' : '' }}" name="notes" id="notes">{!! old('notes', $rawMaterial->notes) !!}</textarea>
                @if($errors->has('notes'))
                    <div class="invalid-feedback">
                        {{ $errors->first('notes') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.rawMaterial.fields.notes_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('is_vegan') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="is_vegan" value="0">
                    <input class="form-check-input" type="checkbox" name="is_vegan" id="is_vegan" value="1" {{ $rawMaterial->is_vegan || old('is_vegan', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_vegan">{{ trans('cruds.rawMaterial.fields.is_vegan') }}</label>
                </div>
                @if($errors->has('is_vegan'))
                    <div class="invalid-feedback">
                        {{ $errors->first('is_vegan') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.rawMaterial.fields.is_vegan_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('is_sustainable') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="is_sustainable" value="0">
                    <input class="form-check-input" type="checkbox" name="is_sustainable" id="is_sustainable" value="1" {{ $rawMaterial->is_sustainable || old('is_sustainable', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_sustainable">{{ trans('cruds.rawMaterial.fields.is_sustainable') }}</label>
                </div>
                @if($errors->has('is_sustainable'))
                    <div class="invalid-feedback">
                        {{ $errors->first('is_sustainable') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.rawMaterial.fields.is_sustainable_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('is_ukfr_std') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="is_ukfr_std" value="0">
                    <input class="form-check-input" type="checkbox" name="is_ukfr_std" id="is_ukfr_std" value="1" {{ $rawMaterial->is_ukfr_std || old('is_ukfr_std', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_ukfr_std">{{ trans('cruds.rawMaterial.fields.is_ukfr_std') }}</label>
                </div>
                @if($errors->has('is_ukfr_std'))
                    <div class="invalid-feedback">
                        {{ $errors->first('is_ukfr_std') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.rawMaterial.fields.is_ukfr_std_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('is_ukfr_treatable') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="is_ukfr_treatable" value="0">
                    <input class="form-check-input" type="checkbox" name="is_ukfr_treatable" id="is_ukfr_treatable" value="1" {{ $rawMaterial->is_ukfr_treatable || old('is_ukfr_treatable', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_ukfr_treatable">{{ trans('cruds.rawMaterial.fields.is_ukfr_treatable') }}</label>
                </div>
                @if($errors->has('is_ukfr_treatable'))
                    <div class="invalid-feedback">
                        {{ $errors->first('is_ukfr_treatable') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.rawMaterial.fields.is_ukfr_treatable_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="std_material_finish_id">{{ trans('cruds.rawMaterial.fields.std_material_finish') }}</label>
                <select class="form-control select2 {{ $errors->has('std_material_finish') ? 'is-invalid' : '' }}" name="std_material_finish_id" id="std_material_finish_id">
                    @foreach($std_material_finishes as $id => $entry)
                        <option value="{{ $id }}" {{ (old('std_material_finish_id') ? old('std_material_finish_id') : $rawMaterial->std_material_finish->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('std_material_finish'))
                    <div class="invalid-feedback">
                        {{ $errors->first('std_material_finish') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.rawMaterial.fields.std_material_finish_helper') }}</span>
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
                xhr.open('POST', '{{ route('admin.raw-materials.storeCKEditorImages') }}', true);
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
                data.append('crud_id', '{{ $rawMaterial->id ?? 0 }}');
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