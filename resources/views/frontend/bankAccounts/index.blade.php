@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('bank_account_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.bank-accounts.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.bankAccount.title_singular') }}
                        </a>
                        <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                            {{ trans('global.app_csvImport') }}
                        </button>
                        @include('csvImport.modal', ['model' => 'BankAccount', 'route' => 'admin.bank-accounts.parseCsvImport'])
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.bankAccount.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-BankAccount">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bankAccount.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.bankAccount.fields.name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.bankAccount.fields.bank_name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.bankAccount.fields.beneficiary') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.bankAccount.fields.company') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.contactCompany.fields.company_short_code') }}
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
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                        <select class="search">
                                            <option value>{{ trans('global.all') }}</option>
                                            @foreach($contact_companies as $key => $item)
                                                <option value="{{ $item->company_name }}">{{ $item->company_name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                    </td>
                                    <td>
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bankAccounts as $key => $bankAccount)
                                    <tr data-entry-id="{{ $bankAccount->id }}">
                                        <td>
                                            {{ $bankAccount->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $bankAccount->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $bankAccount->bank_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $bankAccount->beneficiary ?? '' }}
                                        </td>
                                        <td>
                                            {{ $bankAccount->company->company_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $bankAccount->company->company_short_code ?? '' }}
                                        </td>
                                        <td>
                                            @can('bank_account_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.bank-accounts.show', $bankAccount->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('bank_account_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.bank-accounts.edit', $bankAccount->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('bank_account_delete')
                                                <form action="{{ route('frontend.bank-accounts.destroy', $bankAccount->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('bank_account_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.bank-accounts.massDestroy') }}",
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
  let table = $('.datatable-BankAccount:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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