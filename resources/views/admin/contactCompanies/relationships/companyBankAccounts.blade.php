@can('bank_account_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.bank-accounts.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.bankAccount.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.bankAccount.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-companyBankAccounts">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
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
                </thead>
                <tbody>
                    @foreach($bankAccounts as $key => $bankAccount)
                        <tr data-entry-id="{{ $bankAccount->id }}">
                            <td>

                            </td>
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
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.bank-accounts.show', $bankAccount->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('bank_account_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.bank-accounts.edit', $bankAccount->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('bank_account_delete')
                                    <form action="{{ route('admin.bank-accounts.destroy', $bankAccount->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('bank_account_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.bank-accounts.massDestroy') }}",
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
    order: [[ 4, 'asc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-companyBankAccounts:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection