@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.disciplinary.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.disciplinaries.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.disciplinary.fields.id') }}
                        </th>
                        <td>
                            {{ $disciplinary->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.disciplinary.fields.officer') }}
                        </th>
                        <td>
                            {{ $disciplinary->officer->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.disciplinary.fields.title') }}
                        </th>
                        <td>
                            {{ $disciplinary->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.disciplinary.fields.comment') }}
                        </th>
                        <td>
                            {!! $disciplinary->comment !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.disciplinary.fields.points') }}
                        </th>
                        <td>
                            {{ $disciplinary->points }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.disciplinary.fields.issued_by') }}
                        </th>
                        <td>
                            {{ $disciplinary->issued_by->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.disciplinary.fields.expire_at') }}
                        </th>
                        <td>
                            {{ $disciplinary->expire_at }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.disciplinaries.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection