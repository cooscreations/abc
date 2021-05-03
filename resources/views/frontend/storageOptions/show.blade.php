@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.storageOption.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.storage-options.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.storageOption.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $storageOption->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.storageOption.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $storageOption->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.storageOption.fields.notes') }}
                                    </th>
                                    <td>
                                        {!! $storageOption->notes !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.storageOption.fields.public_url') }}
                                    </th>
                                    <td>
                                        {{ $storageOption->public_url }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.storageOption.fields.list_order') }}
                                    </th>
                                    <td>
                                        {{ $storageOption->list_order }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.storage-options.index') }}">
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