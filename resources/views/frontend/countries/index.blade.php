@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('country_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.countries.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.country.title_singular') }}
                        </a>
                        <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                            {{ trans('global.app_csvImport') }}
                        </button>
                        @include('csvImport.modal', ['model' => 'Country', 'route' => 'admin.countries.parseCsvImport'])
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.country.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Country">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.country.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.country.fields.name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.country.fields.short_code') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.country.fields.alpha_2') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.country.fields.world_region') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.country.fields.default_currency') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.currency.fields.alpha_3') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.country.fields.iso_number') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($countries as $key => $country)
                                    <tr data-entry-id="{{ $country->id }}">
                                        <td>
                                            {{ $country->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $country->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $country->short_code ?? '' }}
                                        </td>
                                        <td>
                                            {{ $country->alpha_2 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $country->world_region->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $country->default_currency->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $country->default_currency->alpha_3 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $country->iso_number ?? '' }}
                                        </td>
                                        <td>
                                            @can('country_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.countries.show', $country->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('country_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.countries.edit', $country->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('country_delete')
                                                <form action="{{ route('frontend.countries.destroy', $country->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('country_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.countries.massDestroy') }}",
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
    order: [[ 1, 'asc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-Country:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection