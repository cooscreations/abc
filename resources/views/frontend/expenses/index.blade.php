@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('expense_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.expenses.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.expense.title_singular') }}
                        </a>
                        <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                            {{ trans('global.app_csvImport') }}
                        </button>
                        @include('csvImport.modal', ['model' => 'Expense', 'route' => 'admin.expenses.parseCsvImport'])
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.expense.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Expense">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.expense.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.expense.fields.expense_category') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.expense.fields.entry_date') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.expense.fields.amount') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.expense.fields.description') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.expense.fields.bank_account') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.expense.fields.currency') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.currency.fields.alpha_3') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.expense.fields.usd_amount') }}
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
                                            @foreach($expense_categories as $key => $item)
                                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
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
                                            @foreach($bank_accounts as $key => $item)
                                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select class="search">
                                            <option value>{{ trans('global.all') }}</option>
                                            @foreach($currencies as $key => $item)
                                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
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
                                @foreach($expenses as $key => $expense)
                                    <tr data-entry-id="{{ $expense->id }}">
                                        <td>
                                            {{ $expense->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $expense->expense_category->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $expense->entry_date ?? '' }}
                                        </td>
                                        <td>
                                            {{ $expense->amount ?? '' }}
                                        </td>
                                        <td>
                                            {{ $expense->description ?? '' }}
                                        </td>
                                        <td>
                                            {{ $expense->bank_account->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $expense->currency->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $expense->currency->alpha_3 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $expense->usd_amount ?? '' }}
                                        </td>
                                        <td>
                                            @can('expense_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.expenses.show', $expense->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('expense_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.expenses.edit', $expense->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('expense_delete')
                                                <form action="{{ route('frontend.expenses.destroy', $expense->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('expense_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.expenses.massDestroy') }}",
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
    order: [[ 2, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-Expense:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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