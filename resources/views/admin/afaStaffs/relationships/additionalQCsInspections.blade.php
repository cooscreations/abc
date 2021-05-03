@can('inspection_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.inspections.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.inspection.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.inspection.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-additionalQCsInspections">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.inspection.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.inspection.fields.order') }}
                        </th>
                        <th>
                            {{ trans('cruds.inspection.fields.inspector_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.inspection.fields.customer') }}
                        </th>
                        <th>
                            {{ trans('cruds.inspection.fields.supplier') }}
                        </th>
                        <th>
                            {{ trans('cruds.inspection.fields.qc_status') }}
                        </th>
                        <th>
                            {{ trans('cruds.inspectionStatus.fields.list_order') }}
                        </th>
                        <th>
                            {{ trans('cruds.inspection.fields.qty_inspected') }}
                        </th>
                        <th>
                            {{ trans('cruds.inspection.fields.inspection_passed') }}
                        </th>
                        <th>
                            {{ trans('cruds.inspection.fields.inspection_planned_date') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($inspections as $key => $inspection)
                        <tr data-entry-id="{{ $inspection->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $inspection->id ?? '' }}
                            </td>
                            <td>
                                {{ $inspection->order->afa_order_num ?? '' }}
                            </td>
                            <td>
                                {{ $inspection->inspector_name->full_name ?? '' }}
                            </td>
                            <td>
                                {{ $inspection->customer->company_short_code ?? '' }}
                            </td>
                            <td>
                                {{ $inspection->supplier->company_short_code ?? '' }}
                            </td>
                            <td>
                                {{ $inspection->qc_status->name ?? '' }}
                            </td>
                            <td>
                                {{ $inspection->qc_status->list_order ?? '' }}
                            </td>
                            <td>
                                {{ $inspection->qty_inspected ?? '' }}
                            </td>
                            <td>
                                <span style="display:none">{{ $inspection->inspection_passed ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $inspection->inspection_passed ? 'checked' : '' }}>
                            </td>
                            <td>
                                {{ $inspection->inspection_planned_date ?? '' }}
                            </td>
                            <td>
                                @can('inspection_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.inspections.show', $inspection->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('inspection_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.inspections.edit', $inspection->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('inspection_delete')
                                    <form action="{{ route('admin.inspections.destroy', $inspection->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('inspection_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.inspections.massDestroy') }}",
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
    order: [[ 2, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-additionalQCsInspections:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection