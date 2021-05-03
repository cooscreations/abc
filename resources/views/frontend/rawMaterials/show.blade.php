@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.rawMaterial.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.raw-materials.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.rawMaterial.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $rawMaterial->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.rawMaterial.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $rawMaterial->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.rawMaterial.fields.notes') }}
                                    </th>
                                    <td>
                                        {!! $rawMaterial->notes !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.rawMaterial.fields.is_vegan') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $rawMaterial->is_vegan ? 'checked' : '' }}>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.rawMaterial.fields.is_sustainable') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $rawMaterial->is_sustainable ? 'checked' : '' }}>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.rawMaterial.fields.is_ukfr_std') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $rawMaterial->is_ukfr_std ? 'checked' : '' }}>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.rawMaterial.fields.is_ukfr_treatable') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $rawMaterial->is_ukfr_treatable ? 'checked' : '' }}>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.rawMaterial.fields.std_material_finish') }}
                                    </th>
                                    <td>
                                        {{ $rawMaterial->std_material_finish->name ?? '' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.raw-materials.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection