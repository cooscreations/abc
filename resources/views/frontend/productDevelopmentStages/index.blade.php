@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('product_development_stage_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.product-development-stages.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.productDevelopmentStage.title_singular') }}
                        </a>
                        <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                            {{ trans('global.app_csvImport') }}
                        </button>
                        @include('csvImport.modal', ['model' => 'ProductDevelopmentStage', 'route' => 'admin.product-development-stages.parseCsvImport'])
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.productDevelopmentStage.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-ProductDevelopmentStage">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.productDevelopmentStage.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.productDevelopmentStage.fields.name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.productDevelopmentStage.fields.list_order') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($productDevelopmentStages as $key => $productDevelopmentStage)
                                    <tr data-entry-id="{{ $productDevelopmentStage->id }}">
                                        <td>
                                            {{ $productDevelopmentStage->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $productDevelopmentStage->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $productDevelopmentStage->list_order ?? '' }}
                                        </td>
                                        <td>
                                            @can('product_development_stage_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.product-development-stages.show', $productDevelopmentStage->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('product_development_stage_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.product-development-stages.edit', $productDevelopmentStage->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('product_development_stage_delete')
                                                <form action="{{ route('frontend.product-development-stages.destroy', $productDevelopmentStage->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('product_development_stage_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.product-development-stages.massDestroy') }}",
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
  let table = $('.datatable-ProductDevelopmentStage:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection