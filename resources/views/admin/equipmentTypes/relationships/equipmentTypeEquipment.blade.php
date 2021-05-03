@can('equipment_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.equipment.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.equipment.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.equipment.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-equipmentTypeEquipment">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.equipment.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.equipment.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.equipment.fields.manufacturer') }}
                        </th>
                        <th>
                            {{ trans('cruds.equipment.fields.equipment_type') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($equipment as $key => $equipment)
                        <tr data-entry-id="{{ $equipment->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $equipment->id ?? '' }}
                            </td>
                            <td>
                                {{ $equipment->name ?? '' }}
                            </td>
                            <td>
                                {{ $equipment->manufacturer->company_name ?? '' }}
                            </td>
                            <td>
                                {{ $equipment->equipment_type->name ?? '' }}
                            </td>
                            <td>
                                @can('equipment_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.equipment.show', $equipment->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('equipment_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.equipment.edit', $equipment->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('equipment_delete')
                                    <form action="{{ route('admin.equipment.destroy', $equipment->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('equipment_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.equipment.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 2, 'asc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-equipmentTypeEquipment:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection