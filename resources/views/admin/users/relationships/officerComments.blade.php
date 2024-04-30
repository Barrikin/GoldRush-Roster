<div class="m-3">
    @can('comment_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.users.comments.create', $user->id) }}">
                    {{ trans('global.add') }} {{ trans('cruds.comment.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.comment.title_singular') }} {{ trans('global.list') }}
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
                                {{ trans('cruds.comment.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.comment.fields.author') }}
                            </th>
                            <th>
                                {{ trans('cruds.comment.fields.comment') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($comments as $key => $comment)
                            <tr data-entry-id="{{ $comment->id }}">
                                @can('table.select.multiple')
                                    <td>

                                    </td>
                                @endcan
                                <td>
                                    {{ $comment->id ?? '' }}
                                </td>
                                <td>
                                    {{ $comment->author->name ?? '' }}
                                </td>
                                <td>
                                    {!! $comment->comment ?? '' !!}
                                </td>
                                <td>
                                    @include('partials.datatablesActions', ['model' => $comment])
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
