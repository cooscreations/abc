@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('company_type_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.company-types.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.companyType.title_singular') }}
                        </a>
                        <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                            {{ trans('global.app_csvImport') }}
                        </button>
                        @include('csvImport.modal', ['model' => 'CompanyType', 'route' => 'admin.company-types.parseCsvImport'])
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.companyType.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-CompanyType">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.companyType.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.companyType.fields.name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.companyType.fields.list_order') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.companyType.fields.icon') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($companyTypes as $key => $companyType)
                                    <tr data-entry-id="{{ $companyType->id }}">
                                        <td>
                                            {{ $companyType->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $companyType->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $companyType->list_order ?? '' }}
                                        </td>
                                        <td>
                                            {{ $companyType->icon ?? '' }}
                                        </td>
                                        <td>
                                            @can('company_type_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.company-types.show', $companyType->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('company_type_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.company-types.edit', $companyType->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('company_type_delete')
                                                <form action="{{ route('frontend.company-types.destroy', $companyType->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('company_type_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.company-types.massDestroy') }}",
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
    pageLength: 25,
  });
  let table = $('.datatable-CompanyType:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection