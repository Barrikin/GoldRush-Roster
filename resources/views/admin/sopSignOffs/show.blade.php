@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.sopSignOff.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.sop-sign-offs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.sopSignOff.fields.id') }}
                        </th>
                        <td>
                            {{ $sopSignOff->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sopSignOff.fields.officer') }}
                        </th>
                        <td>
                            {{ $sopSignOff->officer->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sopSignOff.fields.sop') }}
                        </th>
                        <td>
                            {{ $sopSignOff->sop->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sopSignOff.fields.signed_off_at') }}
                        </th>
                        <td>
                            {{ $sopSignOff->signed_off_at }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.sop-sign-offs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection