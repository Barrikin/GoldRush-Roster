@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.rank.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.ranks.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.rank.fields.id') }}
                        </th>
                        <td>
                            {{ $rank->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.rank.fields.title') }}
                        </th>
                        <td>
                            {{ $rank->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.rank.fields.permissions') }}
                        </th>
                        <td>
                            @foreach($rank->permissions as $key => $permissions)
                                <span class="label label-info">{{ $permissions->title }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.ranks.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection