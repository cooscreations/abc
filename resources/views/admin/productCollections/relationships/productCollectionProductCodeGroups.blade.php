@can('product_code_group_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.product-code-groups.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.productCodeGroup.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.productCodeGroup.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-productCollectionProductCodeGroups">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.productCodeGroup.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.productCodeGroup.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.productCodeGroup.fields.range_start') }}
                        </th>
                        <th>
                            {{ trans('cruds.productCodeGroup.fields.range_end') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($productCodeGroups as $key => $productCodeGroup)
                        <tr data-entry-id="{{ $productCodeGroup->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $productCodeGroup->id ?? '' }}
                            </td>
                            <td>
                                {{ $productCodeGroup->name ?? '' }}
                            </td>
                            <td>
                                {{ $productCodeGroup->range_start ?? '' }}
                            </td>
                            <td>
                                {{ $productCodeGroup->range_end ?? '' }}
                            </td>
                            <td>
                                @can('product_code_group_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.product-code-groups.show', $productCodeGroup->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('product_code_group_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.product-code-groups.edit', $productCodeGroup->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('product_code_group_delete')
                                    <form action="{{ route('admin.product-code-groups.destroy', $productCodeGroup->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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

@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('product_code_group_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.product-code-groups.massDestroy') }}",
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
    order: [[ 3, 'asc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-productCollectionProductCodeGroups:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection