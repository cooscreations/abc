@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.shippingContainer.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.shipping-containers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.shippingContainer.fields.id') }}
                        </th>
                        <td>
                            {{ $shippingContainer->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.shippingContainer.fields.container_number') }}
                        </th>
                        <td>
                            {{ $shippingContainer->container_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.shippingContainer.fields.order') }}
                        </th>
                        <td>
                            {{ $shippingContainer->order->afa_order_num ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.shippingContainer.fields.shipping_company') }}
                        </th>
                        <td>
                            {{ $shippingContainer->shipping_company->company_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.shippingContainer.fields.est_loading_date') }}
                        </th>
                        <td>
                            {{ $shippingContainer->est_loading_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.shippingContainer.fields.actual_loading_date') }}
                        </th>
                        <td>
                            {{ $shippingContainer->actual_loading_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.shippingContainer.fields.booking_date') }}
                        </th>
                        <td>
                            {{ $shippingContainer->booking_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.shippingContainer.fields.so_date') }}
                        </th>
                        <td>
                            {{ $shippingContainer->so_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.shippingContainer.fields.si_date') }}
                        </th>
                        <td>
                            {{ $shippingContainer->si_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.shippingContainer.fields.estimated_time_of_departure') }}
                        </th>
                        <td>
                            {{ $shippingContainer->estimated_time_of_departure }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.shippingContainer.fields.eta') }}
                        </th>
                        <td>
                            {{ $shippingContainer->eta }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.shippingContainer.fields.copy_bl_rec_date') }}
                        </th>
                        <td>
                            {{ $shippingContainer->copy_bl_rec_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.shippingContainer.fields.docs_sent_date') }}
                        </th>
                        <td>
                            {{ $shippingContainer->docs_sent_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.shippingContainer.fields.bl_release_date') }}
                        </th>
                        <td>
                            {{ $shippingContainer->bl_release_date }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.shipping-containers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection