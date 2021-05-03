@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.fabricGroup.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.fabric-groups.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.fabricGroup.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.fabricGroup.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="afa_fabric_group_code">{{ trans('cruds.fabricGroup.fields.afa_fabric_group_code') }}</label>
                <input class="form-control {{ $errors->has('afa_fabric_group_code') ? 'is-invalid' : '' }}" type="text" name="afa_fabric_group_code" id="afa_fabric_group_code" value="{{ old('afa_fabric_group_code', '') }}">
                @if($errors->has('afa_fabric_group_code'))
                    <div class="invalid-feedback">
                        {{ $errors->first('afa_fabric_group_code') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.fabricGroup.fields.afa_fabric_group_code_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="primary_supplier_id">{{ trans('cruds.fabricGroup.fields.primary_supplier') }}</label>
                <select class="form-control select2 {{ $errors->has('primary_supplier') ? 'is-invalid' : '' }}" name="primary_supplier_id" id="primary_supplier_id">
                    @foreach($primary_suppliers as $id => $entry)
                        <option value="{{ $id }}" {{ old('primary_supplier_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('primary_supplier'))
                    <div class="invalid-feedback">
                        {{ $errors->first('primary_supplier') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.fabricGroup.fields.primary_supplier_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="primary_supplier_group_code">{{ trans('cruds.fabricGroup.fields.primary_supplier_group_code') }}</label>
                <input class="form-control {{ $errors->has('primary_supplier_group_code') ? 'is-invalid' : '' }}" type="text" name="primary_supplier_group_code" id="primary_supplier_group_code" value="{{ old('primary_supplier_group_code', '') }}">
                @if($errors->has('primary_supplier_group_code'))
                    <div class="invalid-feedback">
                        {{ $errors->first('primary_supplier_group_code') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.fabricGroup.fields.primary_supplier_group_code_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="sharepoint_url">{{ trans('cruds.fabricGroup.fields.sharepoint_url') }}</label>
                <input class="form-control {{ $errors->has('sharepoint_url') ? 'is-invalid' : '' }}" type="text" name="sharepoint_url" id="sharepoint_url" value="{{ old('sharepoint_url', '') }}">
                @if($errors->has('sharepoint_url'))
                    <div class="invalid-feedback">
                        {{ $errors->first('sharepoint_url') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.fabricGroup.fields.sharepoint_url_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.fabricGroup.fields.description') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{!! old('description') !!}</textarea>
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.fabricGroup.fields.description_helper') }}</span>
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
                xhr.open('POST', '{{ route('admin.fabric-groups.storeCKEditorImages') }}', true);
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
                data.append('crud_id', '{{ $fabricGroup->id ?? 0 }}');
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