@extends('layouts.admin')
@section('content')
@can('bed_sizes_by_region_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.bed-sizes-by-regions.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.bedSizesByRegion.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'BedSizesByRegion', 'route' => 'admin.bed-sizes-by-regions.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.bedSizesByRegion.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-BedSizesByRegion">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.bedSizesByRegion.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.bedSizesByRegion.fields.name') }}
                    </th>
                    <th>
                        {{ trans('cruds.bedSizesByRegion.fields.size_code') }}
                    </th>
                    <th>
                        {{ trans('cruds.bedSizesByRegion.fields.world_region') }}
                    </th>
                    <th>
                        {{ trans('cruds.bedSizesByRegion.fields.size_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.bedSizesByRegion.fields.mattress_w_mm') }}
                    </th>
                    <th>
                        {{ trans('cruds.bedSizesByRegion.fields.mattress_l_mm') }}
                    </th>
                    <th>
                        {{ trans('cruds.bedSizesByRegion.fields.imperial_nickname') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
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
@can('bed_sizes_by_region_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.bed-sizes-by-regions.massDestroy') }}",
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
    ajax: "{{ route('admin.bed-sizes-by-regions.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'name', name: 'name' },
{ data: 'size_code', name: 'size_code' },
{ data: 'world_region_name', name: 'world_region.name' },
{ data: 'size_name_name', name: 'size_name.name' },
{ data: 'mattress_w_mm', name: 'mattress_w_mm' },
{ data: 'mattress_l_mm', name: 'mattress_l_mm' },
{ data: 'imperial_nickname', name: 'imperial_nickname' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 3, 'asc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-BedSizesByRegion').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection