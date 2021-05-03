@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.bedSizeGroup.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.bed-size-groups.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="name">{{ trans('cruds.bedSizeGroup.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bedSizeGroup.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="price_group_id">{{ trans('cruds.bedSizeGroup.fields.price_group') }}</label>
                            <select class="form-control select2" name="price_group_id" id="price_group_id" required>
                                @foreach($price_groups as $id => $entry)
                                    <option value="{{ $id }}" {{ old('price_group_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('price_group'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('price_group') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bedSizeGroup.fields.price_group_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="group_number">{{ trans('cruds.bedSizeGroup.fields.group_number') }}</label>
                            <input class="form-control" type="number" name="group_number" id="group_number" value="{{ old('group_number', '') }}" step="1" required>
                            @if($errors->has('group_number'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('group_number') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bedSizeGroup.fields.group_number_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="is_ukfr" value="0">
                                <input type="checkbox" name="is_ukfr" id="is_ukfr" value="1" {{ old('is_ukfr', 0) == 1 ? 'checked' : '' }}>
                                <label for="is_ukfr">{{ trans('cruds.bedSizeGroup.fields.is_ukfr') }}</label>
                            </div>
                            @if($errors->has('is_ukfr'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('is_ukfr') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bedSizeGroup.fields.is_ukfr_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="mattress_min_w_mm">{{ trans('cruds.bedSizeGroup.fields.mattress_min_w_mm') }}</label>
                            <input class="form-control" type="number" name="mattress_min_w_mm" id="mattress_min_w_mm" value="{{ old('mattress_min_w_mm', '0') }}" step="1">
                            @if($errors->has('mattress_min_w_mm'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('mattress_min_w_mm') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bedSizeGroup.fields.mattress_min_w_mm_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="mattress_max_w_mm">{{ trans('cruds.bedSizeGroup.fields.mattress_max_w_mm') }}</label>
                            <input class="form-control" type="number" name="mattress_max_w_mm" id="mattress_max_w_mm" value="{{ old('mattress_max_w_mm', '0') }}" step="1" required>
                            @if($errors->has('mattress_max_w_mm'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('mattress_max_w_mm') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bedSizeGroup.fields.mattress_max_w_mm_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="mattress_min_l_mm">{{ trans('cruds.bedSizeGroup.fields.mattress_min_l_mm') }}</label>
                            <input class="form-control" type="number" name="mattress_min_l_mm" id="mattress_min_l_mm" value="{{ old('mattress_min_l_mm', '0') }}" step="1" required>
                            @if($errors->has('mattress_min_l_mm'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('mattress_min_l_mm') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bedSizeGroup.fields.mattress_min_l_mm_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="mattress_max_l_mm">{{ trans('cruds.bedSizeGroup.fields.mattress_max_l_mm') }}</label>
                            <input class="form-control" type="number" name="mattress_max_l_mm" id="mattress_max_l_mm" value="{{ old('mattress_max_l_mm', '') }}" step="1" required>
                            @if($errors->has('mattress_max_l_mm'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('mattress_max_l_mm') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bedSizeGroup.fields.mattress_max_l_mm_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="add_gl_approx_usd">{{ trans('cruds.bedSizeGroup.fields.add_gl_approx_usd') }}</label>
                            <input class="form-control" type="number" name="add_gl_approx_usd" id="add_gl_approx_usd" value="{{ old('add_gl_approx_usd', '0.00') }}" step="0.01">
                            @if($errors->has('add_gl_approx_usd'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('add_gl_approx_usd') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bedSizeGroup.fields.add_gl_approx_usd_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="add_pt_approx_usd">{{ trans('cruds.bedSizeGroup.fields.add_pt_approx_usd') }}</label>
                            <input class="form-control" type="number" name="add_pt_approx_usd" id="add_pt_approx_usd" value="{{ old('add_pt_approx_usd', '0.00') }}" step="0.01">
                            @if($errors->has('add_pt_approx_usd'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('add_pt_approx_usd') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bedSizeGroup.fields.add_pt_approx_usd_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="add_2_drawers_approx_usd">{{ trans('cruds.bedSizeGroup.fields.add_2_drawers_approx_usd') }}</label>
                            <input class="form-control" type="number" name="add_2_drawers_approx_usd" id="add_2_drawers_approx_usd" value="{{ old('add_2_drawers_approx_usd', '0.00') }}" step="0.01">
                            @if($errors->has('add_2_drawers_approx_usd'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('add_2_drawers_approx_usd') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bedSizeGroup.fields.add_2_drawers_approx_usd_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="add_mailorder_pkg_approx_usd">{{ trans('cruds.bedSizeGroup.fields.add_mailorder_pkg_approx_usd') }}</label>
                            <input class="form-control" type="number" name="add_mailorder_pkg_approx_usd" id="add_mailorder_pkg_approx_usd" value="{{ old('add_mailorder_pkg_approx_usd', '0.00') }}" step="0.01">
                            @if($errors->has('add_mailorder_pkg_approx_usd'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('add_mailorder_pkg_approx_usd') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bedSizeGroup.fields.add_mailorder_pkg_approx_usd_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="description">{{ trans('cruds.bedSizeGroup.fields.description') }}</label>
                            <textarea class="form-control ckeditor" name="description" id="description">{!! old('description') !!}</textarea>
                            @if($errors->has('description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('description') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bedSizeGroup.fields.description_helper') }}</span>
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
                xhr.open('POST', '{{ route('admin.bed-size-groups.storeCKEditorImages') }}', true);
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
                data.append('crud_id', '{{ $bedSizeGroup->id ?? 0 }}');
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