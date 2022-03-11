@extends('layouts.admin')
@section('content')
@can('newsletter_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.newsletters.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.newsletter.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.newsletter.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Newsletter">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.newsletter.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.newsletter.fields.file_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.newsletter.fields.title') }}
                        </th>
                        <th>
                            {{ trans('cruds.newsletter.fields.content') }}
                        </th>
                        <th>
                            {{ trans('cruds.newsletter.fields.newsletter_date') }}
                        </th>
                        <th>
                            {{ trans('cruds.newsletter.fields.display_flag') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($newsletters as $key => $newsletter)
                        <tr data-entry-id="{{ $newsletter->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $newsletter->id ?? '' }}
                            </td>
                            <td>
                                @if($newsletter->file_name)
                                    <a href="{{ $newsletter->file_name->getUrl() }}" target="_blank">
                                        {{ trans('global.view_file') }}
                                    </a>
                                @endif
                            </td>
                            <td>
                                {{ $newsletter->title ?? '' }}
                            </td>
                            <td>
                                {{ $newsletter->content ?? '' }}
                            </td>
                            <td>
                                {{ $newsletter->newsletter_date ?? '' }}
                            </td>
                            <td>
                                <span style="display:none">{{ $newsletter->display_flag ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $newsletter->display_flag ? 'checked' : '' }}>
                            </td>
                            <td>
                                @can('newsletter_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.newsletters.show', $newsletter->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('newsletter_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.newsletters.edit', $newsletter->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('newsletter_delete')
                                    <form action="{{ route('admin.newsletters.destroy', $newsletter->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('newsletter_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.newsletters.massDestroy') }}",
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
  let table = $('.datatable-Newsletter:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection