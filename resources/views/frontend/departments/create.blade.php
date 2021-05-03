@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.department.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.departments.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="name">{{ trans('cruds.department.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.department.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="dept_code">{{ trans('cruds.department.fields.dept_code') }}</label>
                            <input class="form-control" type="text" name="dept_code" id="dept_code" value="{{ old('dept_code', '') }}">
                            @if($errors->has('dept_code'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('dept_code') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.department.fields.dept_code_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="icon">{{ trans('cruds.department.fields.icon') }}</label>
                            <div class="needsclick dropzone" id="icon-dropzone">
                            </div>
                            @if($errors->has('icon'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('icon') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.department.fields.icon_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="hex_color">{{ trans('cruds.department.fields.hex_color') }}</label>
                            <input class="form-control" type="text" name="hex_color" id="hex_color" value="{{ old('hex_color', '') }}">
                            @if($errors->has('hex_color'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('hex_color') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.department.fields.hex_color_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="dept_intro">{{ trans('cruds.department.fields.dept_intro') }}</label>
                            <textarea class="form-control ckeditor" name="dept_intro" id="dept_intro">{!! old('dept_intro') !!}</textarea>
                            @if($errors->has('dept_intro'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('dept_intro') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.department.fields.dept_intro_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="manager_id">{{ trans('cruds.department.fields.manager') }}</label>
                            <select class="form-control select2" name="manager_id" id="manager_id">
                                @foreach($managers as $id => $entry)
                                    <option value="{{ $id }}" {{ old('manager_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('manager'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('manager') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.department.fields.manager_helper') }}</span>
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
    Dropzone.options.iconDropzone = {
    url: '{{ route('frontend.departments.storeMedia') }}',
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
      $('form').find('input[name="icon"]').remove()
      $('form').append('<input type="hidden" name="icon" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="icon"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($department) && $department->icon)
      var file = {!! json_encode($department->icon) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="icon" value="' + file.file_name + '">')
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
                xhr.open('POST', '{{ route('admin.departments.storeCKEditorImages') }}', true);
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
                data.append('crud_id', '{{ $department->id ?? 0 }}');
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