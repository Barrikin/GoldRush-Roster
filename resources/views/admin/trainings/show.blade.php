@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.training.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.trainings.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.training.fields.id') }}
                        </th>
                        <td>
                            {{ $training->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.training.fields.officer') }}
                        </th>
                        <td>
                            {{ $training->officer->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.training.fields.course') }}
                        </th>
                        <td>
                            {{ $training->course->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.training.fields.understood') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $training->understood ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.training.fields.understood_fto') }}
                        </th>
                        <td>
                            {{ $training->understood_fto->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.training.fields.understood_at') }}
                        </th>
                        <td>
                            {{ $training->understood_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.training.fields.executed') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $training->executed ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.training.fields.executed_fto') }}
                        </th>
                        <td>
                            {{ $training->executed_fto->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.training.fields.executed_at') }}
                        </th>
                        <td>
                            {{ $training->executed_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.training.fields.comments') }}
                        </th>
                        <td>
                            {!! $training->comments !!}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.trainings.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection