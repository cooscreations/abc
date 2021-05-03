@can('afa_staff_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.afa-staffs.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.afaStaff.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.afaStaff.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-departmentAfaStaffs">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.afaStaff.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.afaStaff.fields.full_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.afaStaff.fields.user') }}
                        </th>
                        <th>
                            {{ trans('cruds.afaStaff.fields.staff_level') }}
                        </th>
                        <th>
                            {{ trans('cruds.afaStaff.fields.department') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($afaStaffs as $key => $afaStaff)
                        <tr data-entry-id="{{ $afaStaff->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $afaStaff->id ?? '' }}
                            </td>
                            <td>
                                {{ $afaStaff->full_name ?? '' }}
                            </td>
                            <td>
                                {{ $afaStaff->user->name ?? '' }}
                            </td>
                            <td>
                                {{ $afaStaff->staff_level->name ?? '' }}
                            </td>
                            <td>
                                {{ $afaStaff->department->name ?? '' }}
                            </td>
                            <td>
                                @can('afa_staff_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.afa-staffs.show', $afaStaff->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('afa_staff_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.afa-staffs.edit', $afaStaff->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('afa_staff_delete')
                                    <form action="{{ route('admin.afa-staffs.destroy', $afaStaff->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('afa_staff_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.afa-staffs.massDestroy') }}",
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
  let table = $('.datatable-departmentAfaStaffs:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection