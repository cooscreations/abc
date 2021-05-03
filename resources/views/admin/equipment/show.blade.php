@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.equipment.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.equipment.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.equipment.fields.id') }}
                        </th>
                        <td>
                            {{ $equipment->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.equipment.fields.name') }}
                        </th>
                        <td>
                            {{ $equipment->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.equipment.fields.description') }}
                        </th>
                        <td>
                            {!! $equipment->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.equipment.fields.public_url') }}
                        </th>
                        <td>
                            {{ $equipment->public_url }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.equipment.fields.manufacturer') }}
                        </th>
                        <td>
                            {{ $equipment->manufacturer->company_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.equipment.fields.equipment_type') }}
                        </th>
                        <td>
                            {{ $equipment->equipment_type->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.equipment.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#equipment_equipment_audits" role="tab" data-toggle="tab">
                {{ trans('cruds.equipmentAudit.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="equipment_equipment_audits">
            @includeIf('admin.equipment.relationships.equipmentEquipmentAudits', ['equipmentAudits' => $equipment->equipmentEquipmentAudits])
        </div>
    </div>
</div>

@endsection