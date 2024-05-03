@extends('layouts.admin')
@section('content')
@can('training_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.trainings.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.training.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.training.title_singular') }} {{ trans('global.list') }}
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
                            {{ trans('cruds.training.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.training.fields.officer') }}
                        </th>
                        <th>
                            {{ trans('cruds.training.fields.course') }}
                        </th>
                        <th>
                            {{ trans('cruds.training.fields.understood') }}
                        </th>
                        <th>
                            {{ trans('cruds.training.fields.understood_fto') }}
                        </th>
                        <th>
                            {{ trans('cruds.training.fields.understood_at') }}
                        </th>
                        <th>
                            {{ trans('cruds.training.fields.executed') }}
                        </th>
                        <th>
                            {{ trans('cruds.training.fields.executed_fto') }}
                        </th>
                        <th>
                            {{ trans('cruds.training.fields.executed_at') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($trainings as $key => $training)
                        <tr data-entry-id="{{ $training->id }}" {{ $training->trashed() ? 'class=deleted-row' : '' }}>
                            @can('table.select.multiple')
                                <td>

                                </td>
                            @endcan
                            <td>
                                {{ $training->id ?? '' }}
                            </td>
                            <td>
                                {{ $training->officer->name ?? '' }}
                            </td>
                            <td>
                                {{ $training->course->name ?? '' }}
                            </td>
                            <td>
                                <span style="display:none">{{ $training->understood ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $training->understood ? 'checked' : '' }}>
                            </td>
                            <td>
                                {{ $training->understood_fto->name ?? '' }}
                            </td>
                            <td>
                                {{ $training->understood_at ?? '' }}
                            </td>
                            <td>
                                <span style="display:none">{{ $training->executed ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $training->executed ? 'checked' : '' }}>
                            </td>
                            <td>
                                {{ $training->executed_fto->name ?? '' }}
                            </td>
                            <td>
                                {{ $training->executed_at ?? '' }}
                            </td>
                                <td>
                                    @include('partials.datatablesActions', ['model' => $training])
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
