@can('shipping_container_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.shipping-containers.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.shippingContainer.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.shippingContainer.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-shippingCompanyShippingContainers">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.shippingContainer.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.shippingContainer.fields.container_number') }}
                        </th>
                        <th>
                            {{ trans('cruds.shippingContainer.fields.order') }}
                        </th>
                        <th>
                            {{ trans('cruds.order.fields.afa_order_num') }}
                        </th>
                        <th>
                            {{ trans('cruds.shippingContainer.fields.shipping_company') }}
                        </th>
                        <th>
                            {{ trans('cruds.contactCompany.fields.company_short_code') }}
                        </th>
                        <th>
                            {{ trans('cruds.shippingContainer.fields.est_loading_date') }}
                        </th>
                        <th>
                            {{ trans('cruds.shippingContainer.fields.booking_date') }}
                        </th>
                        <th>
                            {{ trans('cruds.shippingContainer.fields.so_date') }}
                        </th>
                        <th>
                            {{ trans('cruds.shippingContainer.fields.si_date') }}
                        </th>
                        <th>
                            {{ trans('cruds.shippingContainer.fields.estimated_time_of_departure') }}
                        </th>
                        <th>
                            {{ trans('cruds.shippingContainer.fields.eta') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($shippingContainers as $key => $shippingContainer)
                        <tr data-entry-id="{{ $shippingContainer->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $shippingContainer->id ?? '' }}
                            </td>
                            <td>
                                {{ $shippingContainer->container_number ?? '' }}
                            </td>
                            <td>
                                {{ $shippingContainer->order->afa_order_num ?? '' }}
                            </td>
                            <td>
                                {{ $shippingContainer->order->afa_order_num ?? '' }}
                            </td>
                            <td>
                                {{ $shippingContainer->shipping_company->company_name ?? '' }}
                            </td>
                            <td>
                                {{ $shippingContainer->shipping_company->company_short_code ?? '' }}
                            </td>
                            <td>
                                {{ $shippingContainer->est_loading_date ?? '' }}
                            </td>
                            <td>
                                {{ $shippingContainer->booking_date ?? '' }}
                            </td>
                            <td>
                                {{ $shippingContainer->so_date ?? '' }}
                            </td>
                            <td>
                                {{ $shippingContainer->si_date ?? '' }}
                            </td>
                            <td>
                                {{ $shippingContainer->estimated_time_of_departure ?? '' }}
                            </td>
                            <td>
                                {{ $shippingContainer->eta ?? '' }}
                            </td>
                            <td>
                                @can('shipping_container_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.shipping-containers.show', $shippingContainer->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('shipping_container_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.shipping-containers.edit', $shippingContainer->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('shipping_container_delete')
                                    <form action="{{ route('admin.shipping-containers.destroy', $shippingContainer->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('shipping_container_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.shipping-containers.massDestroy') }}",
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
    order: [[ 7, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-shippingCompanyShippingContainers:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection