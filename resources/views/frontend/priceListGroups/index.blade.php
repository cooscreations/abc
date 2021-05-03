@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('price_list_group_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.price-list-groups.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.priceListGroup.title_singular') }}
                        </a>
                        <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                            {{ trans('global.app_csvImport') }}
                        </button>
                        @include('csvImport.modal', ['model' => 'PriceListGroup', 'route' => 'admin.price-list-groups.parseCsvImport'])
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.priceListGroup.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-PriceListGroup">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.priceListGroup.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.priceListGroup.fields.name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.priceListGroup.fields.code') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($priceListGroups as $key => $priceListGroup)
                                    <tr data-entry-id="{{ $priceListGroup->id }}">
                                        <td>
                                            {{ $priceListGroup->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $priceListGroup->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $priceListGroup->code ?? '' }}
                                        </td>
                                        <td>
                                            @can('price_list_group_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.price-list-groups.show', $priceListGroup->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('price_list_group_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.price-list-groups.edit', $priceListGroup->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('price_list_group_delete')
                                                <form action="{{ route('frontend.price-list-groups.destroy', $priceListGroup->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('price_list_group_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.price-list-groups.massDestroy') }}",
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
  let table = $('.datatable-PriceListGroup:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection