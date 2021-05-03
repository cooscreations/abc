@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('company_role_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.company-roles.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.companyRole.title_singular') }}
                        </a>
                        <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                            {{ trans('global.app_csvImport') }}
                        </button>
                        @include('csvImport.modal', ['model' => 'CompanyRole', 'route' => 'admin.company-roles.parseCsvImport'])
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.companyRole.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-CompanyRole">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.companyRole.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.companyRole.fields.company') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.companyRole.fields.role') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.companyRole.fields.contact') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.contactContact.fields.contact_last_name') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($companyRoles as $key => $companyRole)
                                    <tr data-entry-id="{{ $companyRole->id }}">
                                        <td>
                                            {{ $companyRole->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $companyRole->company->company_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $companyRole->role->title ?? '' }}
                                        </td>
                                        <td>
                                            {{ $companyRole->contact->contact_first_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $companyRole->contact->contact_last_name ?? '' }}
                                        </td>
                                        <td>
                                            @can('company_role_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.company-roles.show', $companyRole->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('company_role_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.company-roles.edit', $companyRole->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('company_role_delete')
                                                <form action="{{ route('frontend.company-roles.destroy', $companyRole->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('company_role_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.company-roles.massDestroy') }}",
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
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-CompanyRole:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection