@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.fabricPriceBand.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.fabric-price-bands.update", [$fabricPriceBand->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="name">{{ trans('cruds.fabricPriceBand.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', $fabricPriceBand->name) }}">
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.fabricPriceBand.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="band_letter">{{ trans('cruds.fabricPriceBand.fields.band_letter') }}</label>
                            <input class="form-control" type="text" name="band_letter" id="band_letter" value="{{ old('band_letter', $fabricPriceBand->band_letter) }}">
                            @if($errors->has('band_letter'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('band_letter') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.fabricPriceBand.fields.band_letter_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="description">{{ trans('cruds.fabricPriceBand.fields.description') }}</label>
                            <textarea class="form-control ckeditor" name="description" id="description">{!! old('description', $fabricPriceBand->description) !!}</textarea>
                            @if($errors->has('description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('description') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.fabricPriceBand.fields.description_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="cny_start_price">{{ trans('cruds.fabricPriceBand.fields.cny_start_price') }}</label>
                            <input class="form-control" type="number" name="cny_start_price" id="cny_start_price" value="{{ old('cny_start_price', $fabricPriceBand->cny_start_price) }}" step="0.01" required>
                            @if($errors->has('cny_start_price'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('cny_start_price') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.fabricPriceBand.fields.cny_start_price_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="cny_finish_price">{{ trans('cruds.fabricPriceBand.fields.cny_finish_price') }}</label>
                            <input class="form-control" type="number" name="cny_finish_price" id="cny_finish_price" value="{{ old('cny_finish_price', $fabricPriceBand->cny_finish_price) }}" step="0.01" required>
                            @if($errors->has('cny_finish_price'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('cny_finish_price') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.fabricPriceBand.fields.cny_finish_price_helper') }}</span>
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
                xhr.open('POST', '{{ route('admin.fabric-price-bands.storeCKEditorImages') }}', true);
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
                data.append('crud_id', '{{ $fabricPriceBand->id ?? 0 }}');
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