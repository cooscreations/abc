@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('raw_material_type_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.raw-material-types.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.rawMaterialType.title_singular') }}
                        </a>
                        <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                            {{ trans('global.app_csvImport') }}
                        </button>
                        @include('csvImport.modal', ['model' => 'RawMaterialType', 'route' => 'admin.raw-material-types.parseCsvImport'])
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.rawMaterialType.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-RawMaterialType">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.rawMaterialType.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.rawMaterialType.fields.name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.rawMaterialType.fields.public_url') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($rawMaterialTypes as $key => $rawMaterialType)
                                    <tr data-entry-id="{{ $rawMaterialType->id }}">
                                        <td>
                                            {{ $rawMaterialType->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $rawMaterialType->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $rawMaterialType->public_url ?? '' }}
                                        </td>
                                        <td>
                                            @can('raw_material_type_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.raw-material-types.show', $rawMaterialType->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('raw_material_type_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.raw-material-types.edit', $rawMaterialType->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('raw_material_type_delete')
                                                <form action="{{ route('frontend.raw-material-types.destroy', $rawMaterialType->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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

        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('raw_material_type_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.raw-material-types.massDestroy') }}",
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
    order: [[ 1, 'asc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-RawMaterialType:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection