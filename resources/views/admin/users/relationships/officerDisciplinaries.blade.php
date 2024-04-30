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
                <table class=" table table-bordered table-striped table-hover datatable datatable-{{$pageName}}">
                    <thead>
                        <tr>
                            @can('table.select.multiple')
                                <th width="10">

                                </th>
                            @endcan
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
                                @can('table.select.multiple')
                                    <td>

                                    </td>
                                @endcan
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
                order: [[4, 'desc']],
                @else
                order: [[3, 'desc']],
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
