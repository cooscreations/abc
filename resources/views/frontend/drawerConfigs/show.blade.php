@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.drawerConfig.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.drawer-configs.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.drawerConfig.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $drawerConfig->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.drawerConfig.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $drawerConfig->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.drawerConfig.fields.notes') }}
                                    </th>
                                    <td>
                                        {!! $drawerConfig->notes !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.drawerConfig.fields.public_url') }}
                                    </th>
                                    <td>
                                        {{ $drawerConfig->public_url }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.drawerConfig.fields.photo') }}
                                    </th>
                                    <td>
                                        @if($drawerConfig->photo)
                                            <a href="{{ $drawerConfig->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $drawerConfig->photo->getUrl('thumb') }}">
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.drawer-configs.index') }}">
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