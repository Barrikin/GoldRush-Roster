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
                <table class=" table table-bordered table-striped table-hover datatable datatable-{{$pageName}}">
                    <thead>
                    <tr>
                        @can('table.select.multiple')
                        <th width="10">

                        </th>
                        @endcan
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
                            {{ trans('cruds.user.fields.rank_order') }}
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
                            @can('table.select.multiple')
                            <td>

                            </td>
                            @endcan
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
                            <td>
                                <span>{{ $user->rank?->rank_order ?? '' }}</span>
                            </td>
                            <td>
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
                                @include('partials.datatablesActions', ['model' => $user])
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
    @include('partials.datatablesScripts')
    <script>
        $(function () {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            let dtColumns = $.extend(true, [], $.fn.dataTable.defaults.columnDefs)
            dtColumns.push(
                @if( Gate::allows('table.select.multiple') )
                {targets: 4, visible: false},
                {targets: 5, orderData: 4},
                @else
                {targets: 3, visible: false},
                {targets: 4, orderData: 3},
                @endif
            )
            $.extend(true, $.fn.dataTable.defaults, {
                orderCellsTop: true,
                @if( Gate::allows('table.select.multiple') )
                order: [[5, 'asc'], [1, 'asc']],
                @else
                order: [[4, 'asc'], [0, 'asc']],
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
