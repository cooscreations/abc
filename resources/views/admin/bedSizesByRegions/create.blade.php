@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.bedSizesByRegion.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.bed-sizes-by-regions.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.bedSizesByRegion.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bedSizesByRegion.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="size_code">{{ trans('cruds.bedSizesByRegion.fields.size_code') }}</label>
                <input class="form-control {{ $errors->has('size_code') ? 'is-invalid' : '' }}" type="text" name="size_code" id="size_code" value="{{ old('size_code', '') }}" required>
                @if($errors->has('size_code'))
                    <div class="invalid-feedback">
                        {{ $errors->first('size_code') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bedSizesByRegion.fields.size_code_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="world_region_id">{{ trans('cruds.bedSizesByRegion.fields.world_region') }}</label>
                <select class="form-control select2 {{ $errors->has('world_region') ? 'is-invalid' : '' }}" name="world_region_id" id="world_region_id" required>
                    @foreach($world_regions as $id => $entry)
                        <option value="{{ $id }}" {{ old('world_region_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('world_region'))
                    <div class="invalid-feedback">
                        {{ $errors->first('world_region') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bedSizesByRegion.fields.world_region_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="size_name_id">{{ trans('cruds.bedSizesByRegion.fields.size_name') }}</label>
                <select class="form-control select2 {{ $errors->has('size_name') ? 'is-invalid' : '' }}" name="size_name_id" id="size_name_id">
                    @foreach($size_names as $id => $entry)
                        <option value="{{ $id }}" {{ old('size_name_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('size_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('size_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bedSizesByRegion.fields.size_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="base_style_id">{{ trans('cruds.bedSizesByRegion.fields.base_style') }}</label>
                <select class="form-control select2 {{ $errors->has('base_style') ? 'is-invalid' : '' }}" name="base_style_id" id="base_style_id">
                    @foreach($base_styles as $id => $entry)
                        <option value="{{ $id }}" {{ old('base_style_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('base_style'))
                    <div class="invalid-feedback">
                        {{ $errors->first('base_style') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bedSizesByRegion.fields.base_style_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.bedSizesByRegion.fields.description') }}</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ old('description') }}</textarea>
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bedSizesByRegion.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="related_size_groups">{{ trans('cruds.bedSizesByRegion.fields.related_size_groups') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('related_size_groups') ? 'is-invalid' : '' }}" name="related_size_groups[]" id="related_size_groups" multiple>
                    @foreach($related_size_groups as $id => $related_size_groups)
                        <option value="{{ $id }}" {{ in_array($id, old('related_size_groups', [])) ? 'selected' : '' }}>{{ $related_size_groups }}</option>
                    @endforeach
                </select>
                @if($errors->has('related_size_groups'))
                    <div class="invalid-feedback">
                        {{ $errors->first('related_size_groups') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bedSizesByRegion.fields.related_size_groups_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="mattress_w_mm">{{ trans('cruds.bedSizesByRegion.fields.mattress_w_mm') }}</label>
                <input class="form-control {{ $errors->has('mattress_w_mm') ? 'is-invalid' : '' }}" type="number" name="mattress_w_mm" id="mattress_w_mm" value="{{ old('mattress_w_mm', '') }}" step="1">
                @if($errors->has('mattress_w_mm'))
                    <div class="invalid-feedback">
                        {{ $errors->first('mattress_w_mm') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bedSizesByRegion.fields.mattress_w_mm_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="mattress_l_mm">{{ trans('cruds.bedSizesByRegion.fields.mattress_l_mm') }}</label>
                <input class="form-control {{ $errors->has('mattress_l_mm') ? 'is-invalid' : '' }}" type="number" name="mattress_l_mm" id="mattress_l_mm" value="{{ old('mattress_l_mm', '') }}" step="1">
                @if($errors->has('mattress_l_mm'))
                    <div class="invalid-feedback">
                        {{ $errors->first('mattress_l_mm') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bedSizesByRegion.fields.mattress_l_mm_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="imperial_l_ft_in">{{ trans('cruds.bedSizesByRegion.fields.imperial_l_ft_in') }}</label>
                <input class="form-control {{ $errors->has('imperial_l_ft_in') ? 'is-invalid' : '' }}" type="text" name="imperial_l_ft_in" id="imperial_l_ft_in" value="{{ old('imperial_l_ft_in', '') }}">
                @if($errors->has('imperial_l_ft_in'))
                    <div class="invalid-feedback">
                        {{ $errors->first('imperial_l_ft_in') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bedSizesByRegion.fields.imperial_l_ft_in_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="imperial_w_ft_in">{{ trans('cruds.bedSizesByRegion.fields.imperial_w_ft_in') }}</label>
                <input class="form-control {{ $errors->has('imperial_w_ft_in') ? 'is-invalid' : '' }}" type="text" name="imperial_w_ft_in" id="imperial_w_ft_in" value="{{ old('imperial_w_ft_in', '') }}">
                @if($errors->has('imperial_w_ft_in'))
                    <div class="invalid-feedback">
                        {{ $errors->first('imperial_w_ft_in') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bedSizesByRegion.fields.imperial_w_ft_in_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="imperial_nickname">{{ trans('cruds.bedSizesByRegion.fields.imperial_nickname') }}</label>
                <input class="form-control {{ $errors->has('imperial_nickname') ? 'is-invalid' : '' }}" type="text" name="imperial_nickname" id="imperial_nickname" value="{{ old('imperial_nickname', '') }}">
                @if($errors->has('imperial_nickname'))
                    <div class="invalid-feedback">
                        {{ $errors->first('imperial_nickname') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bedSizesByRegion.fields.imperial_nickname_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="plank_approx_extra_usd">{{ trans('cruds.bedSizesByRegion.fields.plank_approx_extra_usd') }}</label>
                <input class="form-control {{ $errors->has('plank_approx_extra_usd') ? 'is-invalid' : '' }}" type="number" name="plank_approx_extra_usd" id="plank_approx_extra_usd" value="{{ old('plank_approx_extra_usd', '0.00') }}" step="0.01">
                @if($errors->has('plank_approx_extra_usd'))
                    <div class="invalid-feedback">
                        {{ $errors->first('plank_approx_extra_usd') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bedSizesByRegion.fields.plank_approx_extra_usd_helper') }}</span>
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