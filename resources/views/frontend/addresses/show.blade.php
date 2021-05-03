@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.address.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.addresses.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.address.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $address->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.address.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $address->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.address.fields.company') }}
                                    </th>
                                    <td>
                                        {{ $address->company->company_name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.address.fields.add_line_1') }}
                                    </th>
                                    <td>
                                        {{ $address->add_line_1 }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.address.fields.add_line_2') }}
                                    </th>
                                    <td>
                                        {{ $address->add_line_2 }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.address.fields.add_line_3') }}
                                    </th>
                                    <td>
                                        {{ $address->add_line_3 }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.address.fields.city') }}
                                    </th>
                                    <td>
                                        {{ $address->city }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.address.fields.province') }}
                                    </th>
                                    <td>
                                        {{ $address->province->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.address.fields.country') }}
                                    </th>
                                    <td>
                                        {{ $address->country->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.address.fields.is_billing_address') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $address->is_billing_address ? 'checked' : '' }}>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.address.fields.is_shipping_address') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $address->is_shipping_address ? 'checked' : '' }}>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.address.fields.nearest_shipping_port') }}
                                    </th>
                                    <td>
                                        {{ $address->nearest_shipping_port->name ?? '' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.addresses.index') }}">
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