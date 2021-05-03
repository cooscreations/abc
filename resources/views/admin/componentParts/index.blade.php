@extends('layouts.admin')
@section('content')
@can('component_part_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.component-parts.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.componentPart.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'ComponentPart', 'route' => 'admin.component-parts.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.componentPart.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-ComponentPart">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.componentPart.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.componentPart.fields.product_sku') }}
                    </th>
                    <th>
                        {{ trans('cruds.componentPart.fields.component_part_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.componentPart.fields.quantity') }}
                    </th>
                    <th>
                        {{ trans('cruds.componentPart.fields.is_sub_assembly') }}
                    </th>
                    <th>
                        {{ trans('cruds.componentPart.fields.is_optional') }}
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
@can('component_part_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.component-parts.massDestroy') }}",
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
    ajax: "{{ route('admin.component-parts.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'product_sku_product_sku', name: 'product_sku.product_sku' },
{ data: 'component_part_name_name', name: 'component_part_name.name' },
{ data: 'quantity', name: 'quantity' },
{ data: 'is_sub_assembly', name: 'is_sub_assembly' },
{ data: 'is_optional', name: 'is_optional' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 2, 'asc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-ComponentPart').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection