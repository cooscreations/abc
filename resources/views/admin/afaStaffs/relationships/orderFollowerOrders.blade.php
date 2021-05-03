@can('order_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.orders.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.order.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.order.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-orderFollowerOrders">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.order.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.order.fields.afa_order_num') }}
                        </th>
                        <th>
                            {{ trans('cruds.order.fields.order_follower') }}
                        </th>
                        <th>
                            {{ trans('cruds.afaStaff.fields.full_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.order.fields.order_status') }}
                        </th>
                        <th>
                            {{ trans('cruds.order.fields.order_type') }}
                        </th>
                        <th>
                            {{ trans('cruds.order.fields.customer_order_number') }}
                        </th>
                        <th>
                            {{ trans('cruds.order.fields.customer') }}
                        </th>
                        <th>
                            {{ trans('cruds.contactCompany.fields.company_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.order.fields.pi_value_placed_usd') }}
                        </th>
                        <th>
                            {{ trans('cruds.order.fields.customer_deposit_rate') }}
                        </th>
                        <th>
                            {{ trans('cruds.order.fields.customer_balance_usd') }}
                        </th>
                        <th>
                            {{ trans('cruds.order.fields.supplier') }}
                        </th>
                        <th>
                            {{ trans('cruds.order.fields.leadtime_days') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $key => $order)
                        <tr data-entry-id="{{ $order->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $order->id ?? '' }}
                            </td>
                            <td>
                                {{ $order->afa_order_num ?? '' }}
                            </td>
                            <td>
                                {{ $order->order_follower->full_name ?? '' }}
                            </td>
                            <td>
                                {{ $order->order_follower->full_name ?? '' }}
                            </td>
                            <td>
                                {{ $order->order_status->name ?? '' }}
                            </td>
                            <td>
                                {{ $order->order_type->name ?? '' }}
                            </td>
                            <td>
                                {{ $order->customer_order_number ?? '' }}
                            </td>
                            <td>
                                {{ $order->customer->company_name ?? '' }}
                            </td>
                            <td>
                                {{ $order->customer->company_name ?? '' }}
                            </td>
                            <td>
                                {{ $order->pi_value_placed_usd ?? '' }}
                            </td>
                            <td>
                                {{ $order->customer_deposit_rate ?? '' }}
                            </td>
                            <td>
                                {{ $order->customer_balance_usd ?? '' }}
                            </td>
                            <td>
                                {{ $order->supplier->company_name ?? '' }}
                            </td>
                            <td>
                                {{ $order->leadtime_days ?? '' }}
                            </td>
                            <td>
                                @can('order_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.orders.show', $order->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('order_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.orders.edit', $order->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('order_delete')
                                    <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('order_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.orders.massDestroy') }}",
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
  let table = $('.datatable-orderFollowerOrders:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection