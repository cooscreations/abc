@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('contact_contact_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.contact-contacts.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.contactContact.title_singular') }}
                        </a>
                        <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                            {{ trans('global.app_csvImport') }}
                        </button>
                        @include('csvImport.modal', ['model' => 'ContactContact', 'route' => 'admin.contact-contacts.parseCsvImport'])
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.contactContact.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-ContactContact">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.contactContact.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.contactContact.fields.contact_first_name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.contactContact.fields.contact_last_name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.contactContact.fields.local_name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.contactContact.fields.current_country') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.country.fields.name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.contactContact.fields.company') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.contactContact.fields.photo') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.contactContact.fields.contact_email') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.contactContact.fields.mobile_phone') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.contactContact.fields.default_language') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.language.fields.name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.contactContact.fields.roles') }}
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
                                            @foreach($countries as $key => $item)
                                                <option value="{{ $item->alpha_2 }}">{{ $item->alpha_2 }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
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
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                        <select class="search">
                                            <option value>{{ trans('global.all') }}</option>
                                            @foreach($languages as $key => $item)
                                                <option value="{{ $item->alpha_2 }}">{{ $item->alpha_2 }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                    </td>
                                    <td>
                                        <select class="search">
                                            <option value>{{ trans('global.all') }}</option>
                                            @foreach($roles as $key => $item)
                                                <option value="{{ $item->title }}">{{ $item->title }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($contactContacts as $key => $contactContact)
                                    <tr data-entry-id="{{ $contactContact->id }}">
                                        <td>
                                            {{ $contactContact->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $contactContact->contact_first_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $contactContact->contact_last_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $contactContact->local_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $contactContact->current_country->alpha_2 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $contactContact->current_country->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $contactContact->company->company_name ?? '' }}
                                        </td>
                                        <td>
                                            @if($contactContact->photo)
                                                <a href="{{ $contactContact->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                                    <img src="{{ $contactContact->photo->getUrl('thumb') }}">
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $contactContact->contact_email ?? '' }}
                                        </td>
                                        <td>
                                            {{ $contactContact->mobile_phone ?? '' }}
                                        </td>
                                        <td>
                                            {{ $contactContact->default_language->alpha_2 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $contactContact->default_language->name ?? '' }}
                                        </td>
                                        <td>
                                            @foreach($contactContact->roles as $key => $item)
                                                <span>{{ $item->title }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            @can('contact_contact_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.contact-contacts.show', $contactContact->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('contact_contact_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.contact-contacts.edit', $contactContact->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('contact_contact_delete')
                                                <form action="{{ route('frontend.contact-contacts.destroy', $contactContact->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('contact_contact_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.contact-contacts.massDestroy') }}",
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
  let table = $('.datatable-ContactContact:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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