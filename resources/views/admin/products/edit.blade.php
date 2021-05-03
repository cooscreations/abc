@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.product.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.products.update", [$product->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="afa_model_number">{{ trans('cruds.product.fields.afa_model_number') }}</label>
                <input class="form-control {{ $errors->has('afa_model_number') ? 'is-invalid' : '' }}" type="text" name="afa_model_number" id="afa_model_number" value="{{ old('afa_model_number', $product->afa_model_number) }}" required>
                @if($errors->has('afa_model_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('afa_model_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.afa_model_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="primary_nickname_id">{{ trans('cruds.product.fields.primary_nickname') }}</label>
                <select class="form-control select2 {{ $errors->has('primary_nickname') ? 'is-invalid' : '' }}" name="primary_nickname_id" id="primary_nickname_id">
                    @foreach($primary_nicknames as $id => $entry)
                        <option value="{{ $id }}" {{ (old('primary_nickname_id') ? old('primary_nickname_id') : $product->primary_nickname->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('primary_nickname'))
                    <div class="invalid-feedback">
                        {{ $errors->first('primary_nickname') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.primary_nickname_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="product_code_group_id">{{ trans('cruds.product.fields.product_code_group') }}</label>
                <select class="form-control select2 {{ $errors->has('product_code_group') ? 'is-invalid' : '' }}" name="product_code_group_id" id="product_code_group_id">
                    @foreach($product_code_groups as $id => $entry)
                        <option value="{{ $id }}" {{ (old('product_code_group_id') ? old('product_code_group_id') : $product->product_code_group->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('product_code_group'))
                    <div class="invalid-feedback">
                        {{ $errors->first('product_code_group') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.product_code_group_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="default_function_id">{{ trans('cruds.product.fields.default_function') }}</label>
                <select class="form-control select2 {{ $errors->has('default_function') ? 'is-invalid' : '' }}" name="default_function_id" id="default_function_id">
                    @foreach($default_functions as $id => $entry)
                        <option value="{{ $id }}" {{ (old('default_function_id') ? old('default_function_id') : $product->default_function->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('default_function'))
                    <div class="invalid-feedback">
                        {{ $errors->first('default_function') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.default_function_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="product_collection_id">{{ trans('cruds.product.fields.product_collection') }}</label>
                <select class="form-control select2 {{ $errors->has('product_collection') ? 'is-invalid' : '' }}" name="product_collection_id" id="product_collection_id">
                    @foreach($product_collections as $id => $entry)
                        <option value="{{ $id }}" {{ (old('product_collection_id') ? old('product_collection_id') : $product->product_collection->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('product_collection'))
                    <div class="invalid-feedback">
                        {{ $errors->first('product_collection') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.product_collection_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="default_group_id">{{ trans('cruds.product.fields.default_group') }}</label>
                <select class="form-control select2 {{ $errors->has('default_group') ? 'is-invalid' : '' }}" name="default_group_id" id="default_group_id">
                    @foreach($default_groups as $id => $entry)
                        <option value="{{ $id }}" {{ (old('default_group_id') ? old('default_group_id') : $product->default_group->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('default_group'))
                    <div class="invalid-feedback">
                        {{ $errors->first('default_group') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.default_group_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="default_storage_id">{{ trans('cruds.product.fields.default_storage') }}</label>
                <select class="form-control select2 {{ $errors->has('default_storage') ? 'is-invalid' : '' }}" name="default_storage_id" id="default_storage_id">
                    @foreach($default_storages as $id => $entry)
                        <option value="{{ $id }}" {{ (old('default_storage_id') ? old('default_storage_id') : $product->default_storage->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('default_storage'))
                    <div class="invalid-feedback">
                        {{ $errors->first('default_storage') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.default_storage_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="default_gas_lift_config_id">{{ trans('cruds.product.fields.default_gas_lift_config') }}</label>
                <select class="form-control select2 {{ $errors->has('default_gas_lift_config') ? 'is-invalid' : '' }}" name="default_gas_lift_config_id" id="default_gas_lift_config_id">
                    @foreach($default_gas_lift_configs as $id => $entry)
                        <option value="{{ $id }}" {{ (old('default_gas_lift_config_id') ? old('default_gas_lift_config_id') : $product->default_gas_lift_config->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('default_gas_lift_config'))
                    <div class="invalid-feedback">
                        {{ $errors->first('default_gas_lift_config') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.default_gas_lift_config_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="default_drawer_config_id">{{ trans('cruds.product.fields.default_drawer_config') }}</label>
                <select class="form-control select2 {{ $errors->has('default_drawer_config') ? 'is-invalid' : '' }}" name="default_drawer_config_id" id="default_drawer_config_id">
                    @foreach($default_drawer_configs as $id => $entry)
                        <option value="{{ $id }}" {{ (old('default_drawer_config_id') ? old('default_drawer_config_id') : $product->default_drawer_config->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('default_drawer_config'))
                    <div class="invalid-feedback">
                        {{ $errors->first('default_drawer_config') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.default_drawer_config_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="default_drawer_movement_id">{{ trans('cruds.product.fields.default_drawer_movement') }}</label>
                <select class="form-control select2 {{ $errors->has('default_drawer_movement') ? 'is-invalid' : '' }}" name="default_drawer_movement_id" id="default_drawer_movement_id">
                    @foreach($default_drawer_movements as $id => $entry)
                        <option value="{{ $id }}" {{ (old('default_drawer_movement_id') ? old('default_drawer_movement_id') : $product->default_drawer_movement->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('default_drawer_movement'))
                    <div class="invalid-feedback">
                        {{ $errors->first('default_drawer_movement') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.default_drawer_movement_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="default_tv_config_id">{{ trans('cruds.product.fields.default_tv_config') }}</label>
                <select class="form-control select2 {{ $errors->has('default_tv_config') ? 'is-invalid' : '' }}" name="default_tv_config_id" id="default_tv_config_id">
                    @foreach($default_tv_configs as $id => $entry)
                        <option value="{{ $id }}" {{ (old('default_tv_config_id') ? old('default_tv_config_id') : $product->default_tv_config->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('default_tv_config'))
                    <div class="invalid-feedback">
                        {{ $errors->first('default_tv_config') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.default_tv_config_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="default_visitor_config_id">{{ trans('cruds.product.fields.default_visitor_config') }}</label>
                <select class="form-control select2 {{ $errors->has('default_visitor_config') ? 'is-invalid' : '' }}" name="default_visitor_config_id" id="default_visitor_config_id">
                    @foreach($default_visitor_configs as $id => $entry)
                        <option value="{{ $id }}" {{ (old('default_visitor_config_id') ? old('default_visitor_config_id') : $product->default_visitor_config->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('default_visitor_config'))
                    <div class="invalid-feedback">
                        {{ $errors->first('default_visitor_config') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.default_visitor_config_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="extra_letters_used_in_skus">{{ trans('cruds.product.fields.extra_letters_used_in_sku') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('extra_letters_used_in_skus') ? 'is-invalid' : '' }}" name="extra_letters_used_in_skus[]" id="extra_letters_used_in_skus" multiple>
                    @foreach($extra_letters_used_in_skus as $id => $extra_letters_used_in_sku)
                        <option value="{{ $id }}" {{ (in_array($id, old('extra_letters_used_in_skus', [])) || $product->extra_letters_used_in_skus->contains($id)) ? 'selected' : '' }}>{{ $extra_letters_used_in_sku }}</option>
                    @endforeach
                </select>
                @if($errors->has('extra_letters_used_in_skus'))
                    <div class="invalid-feedback">
                        {{ $errors->first('extra_letters_used_in_skus') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.extra_letters_used_in_sku_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="primary_material_id">{{ trans('cruds.product.fields.primary_material') }}</label>
                <select class="form-control select2 {{ $errors->has('primary_material') ? 'is-invalid' : '' }}" name="primary_material_id" id="primary_material_id">
                    @foreach($primary_materials as $id => $entry)
                        <option value="{{ $id }}" {{ (old('primary_material_id') ? old('primary_material_id') : $product->primary_material->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('primary_material'))
                    <div class="invalid-feedback">
                        {{ $errors->first('primary_material') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.primary_material_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="date_launched">{{ trans('cruds.product.fields.date_launched') }}</label>
                <input class="form-control date {{ $errors->has('date_launched') ? 'is-invalid' : '' }}" type="text" name="date_launched" id="date_launched" value="{{ old('date_launched', $product->date_launched) }}">
                @if($errors->has('date_launched'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date_launched') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.date_launched_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="primary_suppliers">{{ trans('cruds.product.fields.primary_suppliers') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('primary_suppliers') ? 'is-invalid' : '' }}" name="primary_suppliers[]" id="primary_suppliers" multiple>
                    @foreach($primary_suppliers as $id => $primary_suppliers)
                        <option value="{{ $id }}" {{ (in_array($id, old('primary_suppliers', [])) || $product->primary_suppliers->contains($id)) ? 'selected' : '' }}>{{ $primary_suppliers }}</option>
                    @endforeach
                </select>
                @if($errors->has('primary_suppliers'))
                    <div class="invalid-feedback">
                        {{ $errors->first('primary_suppliers') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.primary_suppliers_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="std_qty_feet">{{ trans('cruds.product.fields.std_qty_feet') }}</label>
                <input class="form-control {{ $errors->has('std_qty_feet') ? 'is-invalid' : '' }}" type="number" name="std_qty_feet" id="std_qty_feet" value="{{ old('std_qty_feet', $product->std_qty_feet) }}" step="1">
                @if($errors->has('std_qty_feet'))
                    <div class="invalid-feedback">
                        {{ $errors->first('std_qty_feet') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.std_qty_feet_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="std_qty_boxes">{{ trans('cruds.product.fields.std_qty_boxes') }}</label>
                <input class="form-control {{ $errors->has('std_qty_boxes') ? 'is-invalid' : '' }}" type="text" name="std_qty_boxes" id="std_qty_boxes" value="{{ old('std_qty_boxes', $product->std_qty_boxes) }}">
                @if($errors->has('std_qty_boxes'))
                    <div class="invalid-feedback">
                        {{ $errors->first('std_qty_boxes') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.std_qty_boxes_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="std_packaging_id">{{ trans('cruds.product.fields.std_packaging') }}</label>
                <select class="form-control select2 {{ $errors->has('std_packaging') ? 'is-invalid' : '' }}" name="std_packaging_id" id="std_packaging_id">
                    @foreach($std_packagings as $id => $entry)
                        <option value="{{ $id }}" {{ (old('std_packaging_id') ? old('std_packaging_id') : $product->std_packaging->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('std_packaging'))
                    <div class="invalid-feedback">
                        {{ $errors->first('std_packaging') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.std_packaging_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="beauty_shot">{{ trans('cruds.product.fields.beauty_shot') }}</label>
                <div class="needsclick dropzone {{ $errors->has('beauty_shot') ? 'is-invalid' : '' }}" id="beauty_shot-dropzone">
                </div>
                @if($errors->has('beauty_shot'))
                    <div class="invalid-feedback">
                        {{ $errors->first('beauty_shot') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.beauty_shot_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="iso_naked">{{ trans('cruds.product.fields.iso_naked') }}</label>
                <div class="needsclick dropzone {{ $errors->has('iso_naked') ? 'is-invalid' : '' }}" id="iso_naked-dropzone">
                </div>
                @if($errors->has('iso_naked'))
                    <div class="invalid-feedback">
                        {{ $errors->first('iso_naked') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.iso_naked_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="public_description">{{ trans('cruds.product.fields.public_description') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('public_description') ? 'is-invalid' : '' }}" name="public_description" id="public_description">{!! old('public_description', $product->public_description) !!}</textarea>
                @if($errors->has('public_description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('public_description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.public_description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="internal_notes">{{ trans('cruds.product.fields.internal_notes') }}</label>
                <input class="form-control {{ $errors->has('internal_notes') ? 'is-invalid' : '' }}" type="text" name="internal_notes" id="internal_notes" value="{{ old('internal_notes', $product->internal_notes) }}">
                @if($errors->has('internal_notes'))
                    <div class="invalid-feedback">
                        {{ $errors->first('internal_notes') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.internal_notes_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="other_photos">{{ trans('cruds.product.fields.other_photos') }}</label>
                <div class="needsclick dropzone {{ $errors->has('other_photos') ? 'is-invalid' : '' }}" id="other_photos-dropzone">
                </div>
                @if($errors->has('other_photos'))
                    <div class="invalid-feedback">
                        {{ $errors->first('other_photos') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.other_photos_helper') }}</span>
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
    Dropzone.options.beautyShotDropzone = {
    url: '{{ route('admin.products.storeMedia') }}',
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
      $('form').find('input[name="beauty_shot"]').remove()
      $('form').append('<input type="hidden" name="beauty_shot" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="beauty_shot"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($product) && $product->beauty_shot)
      var file = {!! json_encode($product->beauty_shot) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="beauty_shot" value="' + file.file_name + '">')
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
    Dropzone.options.isoNakedDropzone = {
    url: '{{ route('admin.products.storeMedia') }}',
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
      $('form').find('input[name="iso_naked"]').remove()
      $('form').append('<input type="hidden" name="iso_naked" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="iso_naked"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($product) && $product->iso_naked)
      var file = {!! json_encode($product->iso_naked) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="iso_naked" value="' + file.file_name + '">')
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
                xhr.open('POST', '{{ route('admin.products.storeCKEditorImages') }}', true);
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
                data.append('crud_id', '{{ $product->id ?? 0 }}');
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
    var uploadedOtherPhotosMap = {}
Dropzone.options.otherPhotosDropzone = {
    url: '{{ route('admin.products.storeMedia') }}',
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
      $('form').append('<input type="hidden" name="other_photos[]" value="' + response.name + '">')
      uploadedOtherPhotosMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedOtherPhotosMap[file.name]
      }
      $('form').find('input[name="other_photos[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($product) && $product->other_photos)
      var files = {!! json_encode($product->other_photos) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="other_photos[]" value="' + file.file_name + '">')
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
@endsection