@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.document.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.documents.update", [$document->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="name">{{ trans('cruds.document.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $document->name) }}">
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.document.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.document.fields.description') }}</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ old('description', $document->description) }}</textarea>
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.document.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="related_orders">{{ trans('cruds.document.fields.related_orders') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('related_orders') ? 'is-invalid' : '' }}" name="related_orders[]" id="related_orders" multiple>
                    @foreach($related_orders as $id => $related_orders)
                        <option value="{{ $id }}" {{ (in_array($id, old('related_orders', [])) || $document->related_orders->contains($id)) ? 'selected' : '' }}>{{ $related_orders }}</option>
                    @endforeach
                </select>
                @if($errors->has('related_orders'))
                    <div class="invalid-feedback">
                        {{ $errors->first('related_orders') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.document.fields.related_orders_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="related_products">{{ trans('cruds.document.fields.related_products') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('related_products') ? 'is-invalid' : '' }}" name="related_products[]" id="related_products" multiple>
                    @foreach($related_products as $id => $related_products)
                        <option value="{{ $id }}" {{ (in_array($id, old('related_products', [])) || $document->related_products->contains($id)) ? 'selected' : '' }}>{{ $related_products }}</option>
                    @endforeach
                </select>
                @if($errors->has('related_products'))
                    <div class="invalid-feedback">
                        {{ $errors->first('related_products') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.document.fields.related_products_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="related_skus">{{ trans('cruds.document.fields.related_sku') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('related_skus') ? 'is-invalid' : '' }}" name="related_skus[]" id="related_skus" multiple>
                    @foreach($related_skus as $id => $related_sku)
                        <option value="{{ $id }}" {{ (in_array($id, old('related_skus', [])) || $document->related_skus->contains($id)) ? 'selected' : '' }}>{{ $related_sku }}</option>
                    @endforeach
                </select>
                @if($errors->has('related_skus'))
                    <div class="invalid-feedback">
                        {{ $errors->first('related_skus') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.document.fields.related_sku_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="related_users">{{ trans('cruds.document.fields.related_users') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('related_users') ? 'is-invalid' : '' }}" name="related_users[]" id="related_users" multiple>
                    @foreach($related_users as $id => $related_users)
                        <option value="{{ $id }}" {{ (in_array($id, old('related_users', [])) || $document->related_users->contains($id)) ? 'selected' : '' }}>{{ $related_users }}</option>
                    @endforeach
                </select>
                @if($errors->has('related_users'))
                    <div class="invalid-feedback">
                        {{ $errors->first('related_users') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.document.fields.related_users_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="related_companies">{{ trans('cruds.document.fields.related_companies') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('related_companies') ? 'is-invalid' : '' }}" name="related_companies[]" id="related_companies" multiple>
                    @foreach($related_companies as $id => $related_companies)
                        <option value="{{ $id }}" {{ (in_array($id, old('related_companies', [])) || $document->related_companies->contains($id)) ? 'selected' : '' }}>{{ $related_companies }}</option>
                    @endforeach
                </select>
                @if($errors->has('related_companies'))
                    <div class="invalid-feedback">
                        {{ $errors->first('related_companies') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.document.fields.related_companies_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="related_contacts">{{ trans('cruds.document.fields.related_contacts') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('related_contacts') ? 'is-invalid' : '' }}" name="related_contacts[]" id="related_contacts" multiple>
                    @foreach($related_contacts as $id => $related_contacts)
                        <option value="{{ $id }}" {{ (in_array($id, old('related_contacts', [])) || $document->related_contacts->contains($id)) ? 'selected' : '' }}>{{ $related_contacts }}</option>
                    @endforeach
                </select>
                @if($errors->has('related_contacts'))
                    <div class="invalid-feedback">
                        {{ $errors->first('related_contacts') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.document.fields.related_contacts_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="document_type_id">{{ trans('cruds.document.fields.document_type') }}</label>
                <select class="form-control select2 {{ $errors->has('document_type') ? 'is-invalid' : '' }}" name="document_type_id" id="document_type_id">
                    @foreach($document_types as $id => $entry)
                        <option value="{{ $id }}" {{ (old('document_type_id') ? old('document_type_id') : $document->document_type->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('document_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('document_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.document.fields.document_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="file_type_id">{{ trans('cruds.document.fields.file_type') }}</label>
                <select class="form-control select2 {{ $errors->has('file_type') ? 'is-invalid' : '' }}" name="file_type_id" id="file_type_id">
                    @foreach($file_types as $id => $entry)
                        <option value="{{ $id }}" {{ (old('file_type_id') ? old('file_type_id') : $document->file_type->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('file_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('file_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.document.fields.file_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="authorised_user_types">{{ trans('cruds.document.fields.authorised_user_types') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('authorised_user_types') ? 'is-invalid' : '' }}" name="authorised_user_types[]" id="authorised_user_types" multiple>
                    @foreach($authorised_user_types as $id => $authorised_user_types)
                        <option value="{{ $id }}" {{ (in_array($id, old('authorised_user_types', [])) || $document->authorised_user_types->contains($id)) ? 'selected' : '' }}>{{ $authorised_user_types }}</option>
                    @endforeach
                </select>
                @if($errors->has('authorised_user_types'))
                    <div class="invalid-feedback">
                        {{ $errors->first('authorised_user_types') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.document.fields.authorised_user_types_helper') }}</span>
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