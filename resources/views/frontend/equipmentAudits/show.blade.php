@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.equipmentAudit.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.equipment-audits.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.equipmentAudit.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $equipmentAudit->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.equipmentAudit.fields.equipment') }}
                                    </th>
                                    <td>
                                        {{ $equipmentAudit->equipment->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.equipmentAudit.fields.company') }}
                                    </th>
                                    <td>
                                        {{ $equipmentAudit->company->company_name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.equipmentAudit.fields.qty') }}
                                    </th>
                                    <td>
                                        {{ $equipmentAudit->qty }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.equipmentAudit.fields.location') }}
                                    </th>
                                    <td>
                                        {{ $equipmentAudit->location->name ?? '' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.equipment-audits.index') }}">
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