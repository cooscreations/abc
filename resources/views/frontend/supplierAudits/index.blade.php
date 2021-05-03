@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('supplier_audit_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.supplier-audits.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.supplierAudit.title_singular') }}
                        </a>
                        <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                            {{ trans('global.app_csvImport') }}
                        </button>
                        @include('csvImport.modal', ['model' => 'SupplierAudit', 'route' => 'admin.supplier-audits.parseCsvImport'])
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.supplierAudit.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-SupplierAudit">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.supplierAudit.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.supplierAudit.fields.supplier') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.supplierAudit.fields.inspector') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.supplierAudit.fields.audit_date') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.supplierAudit.fields.passed_audit') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.supplierAudit.fields.qty_final_qc') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                                <tr>
                                    <td>
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                        <select class="search">
                                            <option value>{{ trans('global.all') }}</option>
                                            @foreach($contact_companies as $key => $item)
                                                <option value="{{ $item->company_short_code }}">{{ $item->company_short_code }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select class="search">
                                            <option value>{{ trans('global.all') }}</option>
                                            @foreach($users as $key => $item)
                                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                    </td>
                                    <td>
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($supplierAudits as $key => $supplierAudit)
                                    <tr data-entry-id="{{ $supplierAudit->id }}">
                                        <td>
                                            {{ $supplierAudit->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $supplierAudit->supplier->company_short_code ?? '' }}
                                        </td>
                                        <td>
                                            {{ $supplierAudit->inspector->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $supplierAudit->audit_date ?? '' }}
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $supplierAudit->passed_audit ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $supplierAudit->passed_audit ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            {{ $supplierAudit->qty_final_qc ?? '' }}
                                        </td>
                                        <td>
                                            @can('supplier_audit_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.supplier-audits.show', $supplierAudit->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('supplier_audit_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.supplier-audits.edit', $supplierAudit->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('supplier_audit_delete')
                                                <form action="{{ route('frontend.supplier-audits.destroy', $supplierAudit->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('supplier_audit_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.supplier-audits.massDestroy') }}",
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
    order: [[ 3, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-SupplierAudit:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
let visibleColumnsIndexes = null;
$('.datatable thead').on('input', '.search', function () {
      let strict = $(this).attr('strict') || false
      let value = strict && this.value ? "^" + this.value + "$" : this.value

      let index = $(this).parent().index()
      if (visibleColumnsIndexes !== null) {
        index = visibleColumnsIndexes[index]
      }

      table
        .column(index)
        .search(value, strict)
        .draw()
  });
table.on('column-visibility.dt', function(e, settings, column, state) {
      visibleColumnsIndexes = []
      table.columns(":visible").every(function(colIdx) {
          visibleColumnsIndexes.push(colIdx);
      });
  })
})

</script>
@endsection