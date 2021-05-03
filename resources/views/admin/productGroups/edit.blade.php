@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.productGroup.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.product-groups.update", [$productGroup->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="name">{{ trans('cruds.productGroup.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $productGroup->name) }}">
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.productGroup.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.productGroup.fields.description') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{!! old('description', $productGroup->description) !!}</textarea>
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.productGroup.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="logo">{{ trans('cruds.productGroup.fields.logo') }}</label>
                <div class="needsclick dropzone {{ $errors->has('logo') ? 'is-invalid' : '' }}" id="logo-dropzone">
                </div>
                @if($errors->has('logo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('logo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.productGroup.fields.logo_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="public_url">{{ trans('cruds.productGroup.fields.public_url') }}</label>
                <input class="form-control {{ $errors->has('public_url') ? 'is-invalid' : '' }}" type="text" name="public_url" id="public_url" value="{{ old('public_url', $productGroup->public_url) }}">
                @if($errors->has('public_url'))
                    <div class="invalid-feedback">
                        {{ $errors->first('public_url') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.productGroup.fields.public_url_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="sharepoint_url">{{ trans('cruds.productGroup.fields.sharepoint_url') }}</label>
                <input class="form-control {{ $errors->has('sharepoint_url') ? 'is-invalid' : '' }}" type="text" name="sharepoint_url" id="sharepoint_url" value="{{ old('sharepoint_url', $productGroup->sharepoint_url) }}">
                @if($errors->has('sharepoint_url'))
                    <div class="invalid-feedback">
                        {{ $errors->first('sharepoint_url') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.productGroup.fields.sharepoint_url_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="public_logo_url">{{ trans('cruds.productGroup.fields.public_logo_url') }}</label>
                <input class="form-control {{ $errors->has('public_logo_url') ? 'is-invalid' : '' }}" type="text" name="public_logo_url" id="public_logo_url" value="{{ old('public_logo_url', $productGroup->public_logo_url) }}">
                @if($errors->has('public_logo_url'))
                    <div class="invalid-feedback">
                        {{ $errors->first('public_logo_url') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.productGroup.fields.public_logo_url_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="list_order">{{ trans('cruds.productGroup.fields.list_order') }}</label>
                <input class="form-control {{ $errors->has('list_order') ? 'is-invalid' : '' }}" type="number" name="list_order" id="list_order" value="{{ old('list_order', $productGroup->list_order) }}" step="1">
                @if($errors->has('list_order'))
                    <div class="invalid-feedback">
                        {{ $errors->first('list_order') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.productGroup.fields.list_order_helper') }}</span>
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
                xhr.open('POST', '{{ route('admin.product-groups.storeCKEditorImages') }}', true);
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
                data.append('crud_id', '{{ $productGroup->id ?? 0 }}');
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

<script>
    Dropzone.options.logoDropzone = {
    url: '{{ route('admin.product-groups.storeMedia') }}',
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
      $('form').find('input[name="logo"]').remove()
      $('form').append('<input type="hidden" name="logo" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="logo"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($productGroup) && $productGroup->logo)
      var file = {!! json_encode($productGroup->logo) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="logo" value="' + file.file_name + '">')
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