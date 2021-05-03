@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.document.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.documents.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.document.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $document->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.document.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $document->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.document.fields.description') }}
                                    </th>
                                    <td>
                                        {{ $document->description }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.document.fields.related_orders') }}
                                    </th>
                                    <td>
                                        @foreach($document->related_orders as $key => $related_orders)
                                            <span class="label label-info">{{ $related_orders->afa_order_num }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.document.fields.related_products') }}
                                    </th>
                                    <td>
                                        @foreach($document->related_products as $key => $related_products)
                                            <span class="label label-info">{{ $related_products->afa_model_number }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.document.fields.related_sku') }}
                                    </th>
                                    <td>
                                        @foreach($document->related_skus as $key => $related_sku)
                                            <span class="label label-info">{{ $related_sku->product_sku }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.document.fields.related_users') }}
                                    </th>
                                    <td>
                                        @foreach($document->related_users as $key => $related_users)
                                            <span class="label label-info">{{ $related_users->name }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.document.fields.related_companies') }}
                                    </th>
                                    <td>
                                        @foreach($document->related_companies as $key => $related_companies)
                                            <span class="label label-info">{{ $related_companies->company_name }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.document.fields.related_contacts') }}
                                    </th>
                                    <td>
                                        @foreach($document->related_contacts as $key => $related_contacts)
                                            <span class="label label-info">{{ $related_contacts->contact_first_name }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.document.fields.document_type') }}
                                    </th>
                                    <td>
                                        {{ $document->document_type->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.document.fields.file_type') }}
                                    </th>
                                    <td>
                                        {{ $document->file_type->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.document.fields.authorised_user_types') }}
                                    </th>
                                    <td>
                                        @foreach($document->authorised_user_types as $key => $authorised_user_types)
                                            <span class="label label-info">{{ $authorised_user_types->name }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.documents.index') }}">
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