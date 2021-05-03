@can('bed_size_group_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.bed-size-groups.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.bedSizeGroup.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.bedSizeGroup.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-priceGroupBedSizeGroups">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.bedSizeGroup.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.bedSizeGroup.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.bedSizeGroup.fields.price_group') }}
                        </th>
                        <th>
                            {{ trans('cruds.priceListGroup.fields.code') }}
                        </th>
                        <th>
                            {{ trans('cruds.bedSizeGroup.fields.group_number') }}
                        </th>
                        <th>
                            {{ trans('cruds.bedSizeGroup.fields.is_ukfr') }}
                        </th>
                        <th>
                            {{ trans('cruds.bedSizeGroup.fields.mattress_min_w_mm') }}
                        </th>
                        <th>
                            {{ trans('cruds.bedSizeGroup.fields.mattress_max_w_mm') }}
                        </th>
                        <th>
                            {{ trans('cruds.bedSizeGroup.fields.mattress_min_l_mm') }}
                        </th>
                        <th>
                            {{ trans('cruds.bedSizeGroup.fields.mattress_max_l_mm') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bedSizeGroups as $key => $bedSizeGroup)
                        <tr data-entry-id="{{ $bedSizeGroup->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $bedSizeGroup->id ?? '' }}
                            </td>
                            <td>
                                {{ $bedSizeGroup->name ?? '' }}
                            </td>
                            <td>
                                {{ $bedSizeGroup->price_group->name ?? '' }}
                            </td>
                            <td>
                                {{ $bedSizeGroup->price_group->code ?? '' }}
                            </td>
                            <td>
                                {{ $bedSizeGroup->group_number ?? '' }}
                            </td>
                            <td>
                                <span style="display:none">{{ $bedSizeGroup->is_ukfr ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $bedSizeGroup->is_ukfr ? 'checked' : '' }}>
                            </td>
                            <td>
                                {{ $bedSizeGroup->mattress_min_w_mm ?? '' }}
                            </td>
                            <td>
                                {{ $bedSizeGroup->mattress_max_w_mm ?? '' }}
                            </td>
                            <td>
                                {{ $bedSizeGroup->mattress_min_l_mm ?? '' }}
                            </td>
                            <td>
                                {{ $bedSizeGroup->mattress_max_l_mm ?? '' }}
                            </td>
                            <td>
                                @can('bed_size_group_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.bed-size-groups.show', $bedSizeGroup->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('bed_size_group_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.bed-size-groups.edit', $bedSizeGroup->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('bed_size_group_delete')
                                    <form action="{{ route('admin.bed-size-groups.destroy', $bedSizeGroup->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('bed_size_group_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.bed-size-groups.massDestroy') }}",
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
  let table = $('.datatable-priceGroupBedSizeGroups:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection