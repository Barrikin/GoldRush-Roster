@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.certification.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.certifications.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.certification.fields.id') }}
                        </th>
                        <td>
                            {{ $certification->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.certification.fields.name') }}
                        </th>
                        <td>
                            {{ $certification->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.certification.fields.permission') }}
                        </th>
                        <td>
                            @foreach($certification->permissions as $key => $permission)
                                <span class="label label-info">{{ $permission->title }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.certifications.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection