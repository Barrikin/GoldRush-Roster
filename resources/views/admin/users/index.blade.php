@extends('layouts.admin')
@section('content')
@can('user_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.users.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.user.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.user.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-User">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.user.fields.call_sign') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.badge') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.rank') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.status') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.phone_number') }}
                        </th>
                        @can('disciplinary_access')
                            <th>
                                {{ trans('cruds.user.fields.strike_points') }}
                            </th>
                        @endcan
                        <th>
                            {{ trans('cruds.user.fields.certifications') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $key => $user)
                        <tr data-entry-id="{{ $user->id }}">
                            <td>

                            </td>
                            <td>
                                <a href="{{ route('admin.users.show', $user->id) }}">
                                    {{ $user->call_sign ?? '' }}
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('admin.users.show', $user->id) }}">
                                    {{ $user->name ?? '' }}
                            </td>
                            <td>
                                <a href="{{ route('admin.users.show', $user->id) }}">
                                    {{ $user->badge ?? '' }}
                                </a>
                            </td>
                            <td><span hidden="hidden">{{ $user->rank?->id -1 ?? '' }}</span>
                                <a href="{{ route('admin.users.show', $user->id) }}">
                                 {{ $user->rank->title ?? '' }}
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('admin.users.show', $user->id) }}">
                                {{ App\Models\User::STATUS_SELECT[$user->status] ?? '' }}
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('admin.users.show', $user->id) }}">
                                {{ $user->phone_number ?? '' }}
                                </a>
                            </td>
                            @can('disciplinary_access')
                            <td>
                                <a href="{{ route('admin.users.show', $user->id) }}">
                                {{ $user->strike_points ?? '' }}
                                </a>
                            </td>
                            @endcan
                            <td>
                                @foreach($user->certifications as $key => $item)
                                    <span class="badge badge-info">{{ $item->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                @can('user_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.users.show', $user->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('user_edit')
                                        @if (Auth::user()->is_admin || $user->rank_id > Auth::user()->rank_id)
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.users.edit', $user->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                            @endif
                                @endcan

                                @can('user_delete')
                                    @if (Auth::user()->is_admin || $user->rank_id > Auth::user()->rank_id)
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                        @endif
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
        delete dtButtons[2]
        delete dtButtons[3]
        delete dtButtons[4]
        delete dtButtons[5]
        delete dtButtons[6]
@can('user_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.users.massDestroy') }}",
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
    order: [[ 4, 'asc' ], [1, 'asc']],
    pageLength: 100,
  });
  let table = $('.datatable-User:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

})

</script>
@endsection
