@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.storageOption.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.storage-options.update", [$storageOption->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.storageOption.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $storageOption->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.storageOption.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="notes">{{ trans('cruds.storageOption.fields.notes') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('notes') ? 'is-invalid' : '' }}" name="notes" id="notes">{!! old('notes', $storageOption->notes) !!}</textarea>
                @if($errors->has('notes'))
                    <div class="invalid-feedback">
                        {{ $errors->first('notes') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.storageOption.fields.notes_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="public_url">{{ trans('cruds.storageOption.fields.public_url') }}</label>
                <input class="form-control {{ $errors->has('public_url') ? 'is-invalid' : '' }}" type="text" name="public_url" id="public_url" value="{{ old('public_url', $storageOption->public_url) }}">
                @if($errors->has('public_url'))
                    <div class="invalid-feedback">
                        {{ $errors->first('public_url') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.storageOption.fields.public_url_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="list_order">{{ trans('cruds.storageOption.fields.list_order') }}</label>
                <input class="form-control {{ $errors->has('list_order') ? 'is-invalid' : '' }}" type="number" name="list_order" id="list_order" value="{{ old('list_order', $storageOption->list_order) }}" step="1">
                @if($errors->has('list_order'))
                    <div class="invalid-feedback">
                        {{ $errors->first('list_order') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.storageOption.fields.list_order_helper') }}</span>
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
                xhr.open('POST', '{{ route('admin.storage-options.storeCKEditorImages') }}', true);
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
                data.append('crud_id', '{{ $storageOption->id ?? 0 }}');
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