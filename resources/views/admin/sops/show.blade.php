@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.sop.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.sops.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.sop.fields.id') }}
                        </th>
                        <td>
                            {{ $sop->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sop.fields.title') }}
                        </th>
                        <td>
                            {{ $sop->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sop.fields.sop') }}
                        </th>
                        <td>
                            {!! $sop->sop !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sop.fields.rank') }}
                        </th>
                        <td>
                            @foreach($sop->ranks as $key => $rank)
                                <span class="label label-info">{{ $rank->title }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.sops.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection