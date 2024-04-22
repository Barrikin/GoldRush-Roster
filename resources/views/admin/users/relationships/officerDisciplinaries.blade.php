<div class="m-3">
    @can('disciplinary_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.disciplinaries.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.disciplinary.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.disciplinary.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-officerDisciplinaries">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.disciplinary.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.disciplinary.fields.officer') }}
                            </th>
                            <th>
                                {{ trans('cruds.disciplinary.fields.title') }}
                            </th>
                            <th>
                                {{ trans('cruds.disciplinary.fields.points') }}
                            </th>
                            <th>
                                {{ trans('cruds.disciplinary.fields.issued_by') }}
                            </th>
                            <th>
                                {{ trans('cruds.disciplinary.fields.expire_at') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($disciplinaries as $key => $disciplinary)
                            <tr data-entry-id="{{ $disciplinary->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $disciplinary->id ?? '' }}
                                </td>
                                <td>
                                    {{ $disciplinary->officer->name ?? '' }}
                                </td>
                                <td>
                                    {{ $disciplinary->title ?? '' }}
                                </td>
                                <td>
                                    {{ $disciplinary->points ?? '' }}
                                </td>
                                <td>
                                    {{ $disciplinary->issued_by->name ?? '' }}
                                </td>
                                <td>
                                    {{ $disciplinary->expire_at ?? '' }}
                                </td>
                                <td>
                                    @can('disciplinary_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.disciplinaries.show', $disciplinary->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('disciplinary_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.disciplinaries.edit', $disciplinary->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('disciplinary_delete')
                                        <form action="{{ route('admin.disciplinaries.destroy', $disciplinary->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('disciplinary_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.disciplinaries.massDestroy') }}",
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
  let table = $('.datatable-officerDisciplinaries:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection