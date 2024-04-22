@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.user.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.users.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.call_sign') }}
                        </th>
                        <td>
                            {{ $user->call_sign }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.name') }}
                        </th>
                        <td>
                            {{ $user->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.badge') }}
                        </th>
                        <td>
                            {{ $user->badge }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.roles') }}
                        </th>
                        <td>
                            @foreach($user->roles as $key => $roles)
                                <span class="label label-info">{{ $roles->title }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.rank') }}
                        </th>
                        <td>
                            {{ $user->rank->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\User::STATUS_SELECT[$user->status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.phone_number') }}
                        </th>
                        <td>
                            {{ $user->phone_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.hired_on') }}
                        </th>
                        <td>
                            {{ $user->hired_on }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.time_zone') }}
                        </th>
                        <td>
                            {{ $user->time_zone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.strike_points') }}
                        </th>
                        <td>
                            {{ $user->strike_points }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.certifications') }}
                        </th>
                        <td>
                            @foreach($user->certifications as $key => $certifications)
                                <span class="label label-info">{{ $certifications->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.users.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        @can('disciplinary_access')
        <li class="nav-item">
            <a class="nav-link" href="#officer_disciplinaries" role="tab" data-toggle="tab">
                {{ trans('cruds.disciplinary.title') }}
            </a>
        </li>
        @endcan
        @can('comment_access')
        <li class="nav-item">
            <a class="nav-link" href="#officer_comments" role="tab" data-toggle="tab">
                {{ trans('cruds.comment.title') }}
            </a>
        </li>
            @endcan
            @can('training_access')
        <li class="nav-item">
            <a class="nav-link" href="#officer_trainings" role="tab" data-toggle="tab">
                {{ trans('cruds.training.title') }}
            </a>
        </li>
            @endcan
        <li class="nav-item">
            <a class="nav-link" href="#officer_sop_sign_offs" role="tab" data-toggle="tab">
                {{ trans('cruds.sopSignOff.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#user_user_alerts" role="tab" data-toggle="tab">
                {{ trans('cruds.userAlert.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="officer_disciplinaries">
            @includeIf('admin.users.relationships.officerDisciplinaries', ['disciplinaries' => $user->officerDisciplinaries])
        </div>
        <div class="tab-pane" role="tabpanel" id="officer_comments">
            @includeIf('admin.users.relationships.officerComments', ['comments' => $user->officerComments])
        </div>
        <div class="tab-pane" role="tabpanel" id="officer_trainings">
            @includeIf('admin.users.relationships.officerTrainings', ['trainings' => $user->officerTrainings])
        </div>
        <div class="tab-pane" role="tabpanel" id="officer_sop_sign_offs">
            @includeIf('admin.users.relationships.officerSopSignOffs', ['sopSignOffs' => $user->officerSopSignOffs])
        </div>
        <div class="tab-pane" role="tabpanel" id="user_user_alerts">
            @includeIf('admin.users.relationships.userUserAlerts', ['userAlerts' => $user->userUserAlerts])
        </div>
    </div>
</div>

@endsection
