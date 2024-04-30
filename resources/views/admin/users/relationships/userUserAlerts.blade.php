<div class="m-3">
    @can('user_alert_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.user-alerts.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.userAlert.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.userAlert.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-{{$pageName}}">
                    <thead>
                        <tr>
                            @can('table.select.multiple')
                                <th width="10">

                                </th>
                            @endcan
                            <th>
                                {{ trans('cruds.userAlert.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.userAlert.fields.alert_text') }}
                            </th>
                            <th>
                                {{ trans('cruds.userAlert.fields.alert_link') }}
                            </th>
                            <th>
                                {{ trans('cruds.userAlert.fields.user') }}
                            </th>
                            <th>
                                {{ trans('cruds.userAlert.fields.created_at') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($userAlerts as $key => $userAlert)
                            <tr data-entry-id="{{ $userAlert->id }}">
                                @can('table.select.multiple')
                                    <td>

                                    </td>
                                @endcan
                                <td>
                                    {{ $userAlert->id ?? '' }}
                                </td>
                                <td>
                                    {{ $userAlert->alert_text ?? '' }}
                                </td>
                                <td>
                                    {{ $userAlert->alert_link ?? '' }}
                                </td>
                                <td>
                                    @foreach($userAlert->users as $key => $item)
                                        <span class="badge badge-info">{{ $item->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    {{ $userAlert->created_at ?? '' }}
                                </td>
                                    <td>
                                        @include('partials.datatablesActions', ['model' => $disciplinary])
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
@include('partials.datatablesScripts')
<script>
    $(function () {
        let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
        let dtColumns = $.extend(true, [], $.fn.dataTable.defaults.columnDefs)
        $.extend(true, $.fn.dataTable.defaults, {
            orderCellsTop: true,
            @if( Gate::allows('table.select.multiple') )
            order: [[1, 'asc']],
            @else
            order: [[0, 'asc']],
            @endif
            pageLength: 100,
        });
        let table = $('.datatable-{{$pageName}}:not(.ajaxTable)').DataTable({
            buttons: dtButtons,
            columnDefs: dtColumns,
        })
        $('a[data-toggle="tab"]').on('shown.bs.tab click', function (e) {
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust();
        });

    })

</script>
@endsection
