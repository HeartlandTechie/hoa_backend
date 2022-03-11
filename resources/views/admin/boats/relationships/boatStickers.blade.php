<div class="m-3">
    @can('sticker_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.stickers.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.sticker.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.sticker.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-boatStickers">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.sticker.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.sticker.fields.year') }}
                            </th>
                            <th>
                                {{ trans('cruds.sticker.fields.sticker_number') }}
                            </th>
                            <th>
                                {{ trans('cruds.sticker.fields.address') }}
                            </th>
                            <th>
                                {{ trans('cruds.address.fields.street_address') }}
                            </th>
                            <th>
                                {{ trans('cruds.address.fields.street_name') }}
                            </th>
                            <th>
                                {{ trans('cruds.address.fields.lot_number') }}
                            </th>
                            <th>
                                {{ trans('cruds.sticker.fields.boat') }}
                            </th>
                            <th>
                                {{ trans('cruds.boat.fields.description') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($stickers as $key => $sticker)
                            <tr data-entry-id="{{ $sticker->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $sticker->id ?? '' }}
                                </td>
                                <td>
                                    {{ $sticker->year ?? '' }}
                                </td>
                                <td>
                                    {{ $sticker->sticker_number ?? '' }}
                                </td>
                                <td>
                                    {{ $sticker->address->address ?? '' }}
                                </td>
                                <td>
                                    {{ $sticker->address->street_address ?? '' }}
                                </td>
                                <td>
                                    {{ $sticker->address->street_name ?? '' }}
                                </td>
                                <td>
                                    {{ $sticker->address->lot_number ?? '' }}
                                </td>
                                <td>
                                    {{ $sticker->boat->type ?? '' }}
                                </td>
                                <td>
                                    {{ $sticker->boat->description ?? '' }}
                                </td>
                                <td>
                                    @can('sticker_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.stickers.show', $sticker->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('sticker_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.stickers.edit', $sticker->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('sticker_delete')
                                        <form action="{{ route('admin.stickers.destroy', $sticker->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('sticker_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.stickers.massDestroy') }}",
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
  let table = $('.datatable-boatStickers:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection