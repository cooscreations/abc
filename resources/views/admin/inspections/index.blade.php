@extends('layouts.admin')
@section('content')
@can('inspection_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.inspections.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.inspection.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'Inspection', 'route' => 'admin.inspections.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.inspection.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Inspection">
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
                <tr>
                    <td>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($orders as $key => $item)
                                <option value="{{ $item->afa_order_num }}">{{ $item->afa_order_num }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($afa_staffs as $key => $item)
                                <option value="{{ $item->full_name }}">{{ $item->full_name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($contact_companies as $key => $item)
                                <option value="{{ $item->company_short_code }}">{{ $item->company_short_code }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($contact_companies as $key => $item)
                                <option value="{{ $item->company_short_code }}">{{ $item->company_short_code }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($inspection_statuses as $key => $item)
                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                </tr>
            </thead>
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('inspection_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.inspections.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
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

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.inspections.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'order_afa_order_num', name: 'order.afa_order_num' },
{ data: 'inspector_name_full_name', name: 'inspector_name.full_name' },
{ data: 'customer_company_short_code', name: 'customer.company_short_code' },
{ data: 'supplier_company_short_code', name: 'supplier.company_short_code' },
{ data: 'qc_status_name', name: 'qc_status.name' },
{ data: 'qc_status.list_order', name: 'qc_status.list_order' },
{ data: 'qty_inspected', name: 'qty_inspected' },
{ data: 'inspection_passed', name: 'inspection_passed' },
{ data: 'inspection_planned_date', name: 'inspection_planned_date' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 2, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-Inspection').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
let visibleColumnsIndexes = null;
$('.datatable thead').on('input', '.search', function () {
      let strict = $(this).attr('strict') || false
      let value = strict && this.value ? "^" + this.value + "$" : this.value

      let index = $(this).parent().index()
      if (visibleColumnsIndexes !== null) {
        index = visibleColumnsIndexes[index]
      }

      table
        .column(index)
        .search(value, strict)
        .draw()
  });
table.on('column-visibility.dt', function(e, settings, column, state) {
      visibleColumnsIndexes = []
      table.columns(":visible").every(function(colIdx) {
          visibleColumnsIndexes.push(colIdx);
      });
  })
});

</script>
@endsection