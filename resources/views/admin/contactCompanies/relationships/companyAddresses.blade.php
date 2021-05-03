@can('address_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.addresses.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.address.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.address.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-companyAddresses">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.address.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.address.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.address.fields.company') }}
                        </th>
                        <th>
                            {{ trans('cruds.address.fields.city') }}
                        </th>
                        <th>
                            {{ trans('cruds.address.fields.province') }}
                        </th>
                        <th>
                            {{ trans('cruds.province.fields.local_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.address.fields.country') }}
                        </th>
                        <th>
                            {{ trans('cruds.country.fields.alpha_2') }}
                        </th>
                        <th>
                            {{ trans('cruds.address.fields.is_billing_address') }}
                        </th>
                        <th>
                            {{ trans('cruds.address.fields.is_shipping_address') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($addresses as $key => $address)
                        <tr data-entry-id="{{ $address->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $address->id ?? '' }}
                            </td>
                            <td>
                                {{ $address->name ?? '' }}
                            </td>
                            <td>
                                {{ $address->company->company_name ?? '' }}
                            </td>
                            <td>
                                {{ $address->city ?? '' }}
                            </td>
                            <td>
                                {{ $address->province->name ?? '' }}
                            </td>
                            <td>
                                {{ $address->province->local_name ?? '' }}
                            </td>
                            <td>
                                {{ $address->country->name ?? '' }}
                            </td>
                            <td>
                                {{ $address->country->alpha_2 ?? '' }}
                            </td>
                            <td>
                                <span style="display:none">{{ $address->is_billing_address ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $address->is_billing_address ? 'checked' : '' }}>
                            </td>
                            <td>
                                <span style="display:none">{{ $address->is_shipping_address ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $address->is_shipping_address ? 'checked' : '' }}>
                            </td>
                            <td>
                                @can('address_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.addresses.show', $address->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('address_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.addresses.edit', $address->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('address_delete')
                                    <form action="{{ route('admin.addresses.destroy', $address->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('address_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.addresses.massDestroy') }}",
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
  let table = $('.datatable-companyAddresses:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection