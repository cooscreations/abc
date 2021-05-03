@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('component_part_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.component-parts.create') }}">
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
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-ComponentPart">
                            <thead>
                                <tr>
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
                            <tbody>
                                @foreach($componentParts as $key => $componentPart)
                                    <tr data-entry-id="{{ $componentPart->id }}">
                                        <td>
                                            {{ $componentPart->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $componentPart->product_sku->product_sku ?? '' }}
                                        </td>
                                        <td>
                                            {{ $componentPart->component_part_name->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $componentPart->quantity ?? '' }}
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $componentPart->is_sub_assembly ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $componentPart->is_sub_assembly ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $componentPart->is_optional ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $componentPart->is_optional ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            @can('component_part_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.component-parts.show', $componentPart->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('component_part_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.component-parts.edit', $componentPart->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('component_part_delete')
                                                <form action="{{ route('frontend.component-parts.destroy', $componentPart->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('component_part_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.component-parts.massDestroy') }}",
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
  let table = $('.datatable-ComponentPart:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection