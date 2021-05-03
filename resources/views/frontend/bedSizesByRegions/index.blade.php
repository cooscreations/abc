@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('bed_sizes_by_region_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.bed-sizes-by-regions.create') }}">
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
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-BedSizesByRegion">
                            <thead>
                                <tr>
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
                            <tbody>
                                @foreach($bedSizesByRegions as $key => $bedSizesByRegion)
                                    <tr data-entry-id="{{ $bedSizesByRegion->id }}">
                                        <td>
                                            {{ $bedSizesByRegion->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $bedSizesByRegion->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $bedSizesByRegion->size_code ?? '' }}
                                        </td>
                                        <td>
                                            {{ $bedSizesByRegion->world_region->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $bedSizesByRegion->size_name->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $bedSizesByRegion->mattress_w_mm ?? '' }}
                                        </td>
                                        <td>
                                            {{ $bedSizesByRegion->mattress_l_mm ?? '' }}
                                        </td>
                                        <td>
                                            {{ $bedSizesByRegion->imperial_nickname ?? '' }}
                                        </td>
                                        <td>
                                            @can('bed_sizes_by_region_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.bed-sizes-by-regions.show', $bedSizesByRegion->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('bed_sizes_by_region_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.bed-sizes-by-regions.edit', $bedSizesByRegion->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('bed_sizes_by_region_delete')
                                                <form action="{{ route('frontend.bed-sizes-by-regions.destroy', $bedSizesByRegion->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('bed_sizes_by_region_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.bed-sizes-by-regions.massDestroy') }}",
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
  let table = $('.datatable-BedSizesByRegion:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection