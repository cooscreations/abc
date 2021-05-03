@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('fabric_group_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.fabric-groups.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.fabricGroup.title_singular') }}
                        </a>
                        <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                            {{ trans('global.app_csvImport') }}
                        </button>
                        @include('csvImport.modal', ['model' => 'FabricGroup', 'route' => 'admin.fabric-groups.parseCsvImport'])
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.fabricGroup.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-FabricGroup">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.fabricGroup.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.fabricGroup.fields.name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.fabricGroup.fields.afa_fabric_group_code') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($fabricGroups as $key => $fabricGroup)
                                    <tr data-entry-id="{{ $fabricGroup->id }}">
                                        <td>
                                            {{ $fabricGroup->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $fabricGroup->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $fabricGroup->afa_fabric_group_code ?? '' }}
                                        </td>
                                        <td>
                                            @can('fabric_group_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.fabric-groups.show', $fabricGroup->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('fabric_group_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.fabric-groups.edit', $fabricGroup->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('fabric_group_delete')
                                                <form action="{{ route('frontend.fabric-groups.destroy', $fabricGroup->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('fabric_group_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.fabric-groups.massDestroy') }}",
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
  let table = $('.datatable-FabricGroup:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection