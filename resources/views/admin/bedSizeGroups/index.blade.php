@extends('layouts.admin')
@section('content')
@can('bed_size_group_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.bed-size-groups.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.bedSizeGroup.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'BedSizeGroup', 'route' => 'admin.bed-size-groups.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.bedSizeGroup.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-BedSizeGroup">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.bedSizeGroup.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.bedSizeGroup.fields.name') }}
                    </th>
                    <th>
                        {{ trans('cruds.bedSizeGroup.fields.price_group') }}
                    </th>
                    <th>
                        {{ trans('cruds.priceListGroup.fields.code') }}
                    </th>
                    <th>
                        {{ trans('cruds.bedSizeGroup.fields.group_number') }}
                    </th>
                    <th>
                        {{ trans('cruds.bedSizeGroup.fields.is_ukfr') }}
                    </th>
                    <th>
                        {{ trans('cruds.bedSizeGroup.fields.mattress_min_w_mm') }}
                    </th>
                    <th>
                        {{ trans('cruds.bedSizeGroup.fields.mattress_max_w_mm') }}
                    </th>
                    <th>
                        {{ trans('cruds.bedSizeGroup.fields.mattress_min_l_mm') }}
                    </th>
                    <th>
                        {{ trans('cruds.bedSizeGroup.fields.mattress_max_l_mm') }}
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
                            @foreach($price_list_groups as $key => $item)
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
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
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
@can('bed_size_group_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.bed-size-groups.massDestroy') }}",
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
    ajax: "{{ route('admin.bed-size-groups.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'name', name: 'name' },
{ data: 'price_group_name', name: 'price_group.name' },
{ data: 'price_group.code', name: 'price_group.code' },
{ data: 'group_number', name: 'group_number' },
{ data: 'is_ukfr', name: 'is_ukfr' },
{ data: 'mattress_min_w_mm', name: 'mattress_min_w_mm' },
{ data: 'mattress_max_w_mm', name: 'mattress_max_w_mm' },
{ data: 'mattress_min_l_mm', name: 'mattress_min_l_mm' },
{ data: 'mattress_max_l_mm', name: 'mattress_max_l_mm' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 2, 'asc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-BedSizeGroup').DataTable(dtOverrideGlobals);
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