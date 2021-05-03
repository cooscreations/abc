@can('fabric_nickname_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.fabric-nicknames.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.fabricNickname.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.fabricNickname.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-fabricFabricNicknames">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.fabricNickname.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.fabricNickname.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.fabricNickname.fields.fabric') }}
                        </th>
                        <th>
                            {{ trans('cruds.fabric.fields.fabric_code') }}
                        </th>
                        <th>
                            {{ trans('cruds.fabricNickname.fields.customer') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($fabricNicknames as $key => $fabricNickname)
                        <tr data-entry-id="{{ $fabricNickname->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $fabricNickname->id ?? '' }}
                            </td>
                            <td>
                                {{ $fabricNickname->name ?? '' }}
                            </td>
                            <td>
                                {{ $fabricNickname->fabric->name ?? '' }}
                            </td>
                            <td>
                                {{ $fabricNickname->fabric->fabric_code ?? '' }}
                            </td>
                            <td>
                                {{ $fabricNickname->customer->company_name ?? '' }}
                            </td>
                            <td>
                                @can('fabric_nickname_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.fabric-nicknames.show', $fabricNickname->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('fabric_nickname_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.fabric-nicknames.edit', $fabricNickname->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('fabric_nickname_delete')
                                    <form action="{{ route('admin.fabric-nicknames.destroy', $fabricNickname->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('fabric_nickname_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.fabric-nicknames.massDestroy') }}",
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
  let table = $('.datatable-fabricFabricNicknames:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection