@extends('layouts.admin')
@section('content')
@can('shipping_container_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.shipping-containers.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.shippingContainer.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'ShippingContainer', 'route' => 'admin.shipping-containers.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.shippingContainer.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-ShippingContainer">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.shippingContainer.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.shippingContainer.fields.container_number') }}
                    </th>
                    <th>
                        {{ trans('cruds.shippingContainer.fields.order') }}
                    </th>
                    <th>
                        {{ trans('cruds.order.fields.afa_order_num') }}
                    </th>
                    <th>
                        {{ trans('cruds.shippingContainer.fields.shipping_company') }}
                    </th>
                    <th>
                        {{ trans('cruds.contactCompany.fields.company_short_code') }}
                    </th>
                    <th>
                        {{ trans('cruds.shippingContainer.fields.est_loading_date') }}
                    </th>
                    <th>
                        {{ trans('cruds.shippingContainer.fields.booking_date') }}
                    </th>
                    <th>
                        {{ trans('cruds.shippingContainer.fields.so_date') }}
                    </th>
                    <th>
                        {{ trans('cruds.shippingContainer.fields.si_date') }}
                    </th>
                    <th>
                        {{ trans('cruds.shippingContainer.fields.estimated_time_of_departure') }}
                    </th>
                    <th>
                        {{ trans('cruds.shippingContainer.fields.eta') }}
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
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($contact_companies as $key => $item)
                                <option value="{{ $item->company_name }}">{{ $item->company_name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
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
@can('shipping_container_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.shipping-containers.massDestroy') }}",
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
    ajax: "{{ route('admin.shipping-containers.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'container_number', name: 'container_number' },
{ data: 'order_afa_order_num', name: 'order.afa_order_num' },
{ data: 'order.afa_order_num', name: 'order.afa_order_num' },
{ data: 'shipping_company_company_name', name: 'shipping_company.company_name' },
{ data: 'shipping_company.company_short_code', name: 'shipping_company.company_short_code' },
{ data: 'est_loading_date', name: 'est_loading_date' },
{ data: 'booking_date', name: 'booking_date' },
{ data: 'so_date', name: 'so_date' },
{ data: 'si_date', name: 'si_date' },
{ data: 'estimated_time_of_departure', name: 'estimated_time_of_departure' },
{ data: 'eta', name: 'eta' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 7, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-ShippingContainer').DataTable(dtOverrideGlobals);
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