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
                        <td {{ (Gate::allows('disciplinary_view')) ? 'rowspan=6': 'rowspan=5' }} colspan="2" width="30%">
                            <img width="100%" height="100%" src="{{asset('images/default-avatar.png')}}">
                        </td>
                        <td>
                            {{ $user->name }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{ trans('cruds.user.fields.rank') }}: {{ $user->rank->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{ trans('cruds.user.fields.phone_number') }}: {{ $user->phone_number }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{ trans('cruds.user.fields.hired_on') }}: {{ $user->hired_on }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{ trans('cruds.user.fields.status') }}: {{ App\Models\User::STATUS_SELECT[$user->status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{ trans('cruds.user.fields.time_zone') }}: {{ $user->time_zone }}
                        </td>
                    </tr>
                    <tr>
                        <td width="10%">
                            {{ trans('cruds.user.fields.call_sign') }}: {{ $user->call_sign }}
                        </td>
                        <td width="10%">
                            {{ trans('cruds.user.fields.badge') }} #: {{ $user->badge }}
                        </td>
                            @can('disciplinary_view')
                            <td>
                                {{ trans('cruds.user.fields.strike_points') }}: {{ $user->strike_points }}
                            </td>
                            @endcan
                    </tr>
                    <tr>
                        <td colspan="3">
                            {{ trans('cruds.user.fields.roles') }}:
                            @foreach($user->roles as $key => $roles)
                                <span class="badge badge-info">{{ $roles->title }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            {{ trans('cruds.user.fields.certifications') }}:
                            @foreach($user->certifications as $key => $item)
                                <span class="badge badge-info">{{ $item->name }}</span>
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
        @if( Gate::allows('disciplinary_access') OR Auth::user()->id == $user->id )
        <li class="nav-item">
            <a class="nav-link {{ app('request')->input('tab') == 'officer_disciplinaries' ? 'active' : '' }}" href="#officer_disciplinaries" role="tab" data-toggle="tab">
                {{ trans('cruds.disciplinary.title') }}
            </a>
        </li>
        @endif
        @can('comment_access')
        <li class="nav-item">
            <a class="nav-link {{ app('request')->input('tab') == 'officer_comments' ? 'active' : '' }}" href="#officer_comments" role="tab" data-toggle="tab">
                {{ trans('cruds.comment.title') }}
            </a>
        </li>
            @endcan
            @if( Gate::allows('training_access') OR Auth::user()->id == $user->id )
        <li class="nav-item">
            <a class="nav-link {{ app('request')->input('tab') == 'officer_trainings' ? 'active' : '' }}" href="#officer_trainings" role="tab" data-toggle="tab">
                {{ trans('cruds.training.title') }}
            </a>
        </li>
            @endif
            @if( Gate::allows('sop_sign_off_access') OR Auth::user()->id == $user->id )
        <li class="nav-item">
            <a class="nav-link {{ app('request')->input('tab') == 'officer_sop_sign_offs' ? 'active' : '' }}" href="#officer_sop_sign_offs" role="tab" data-toggle="tab">
                {{ trans('cruds.sopSignOff.title') }}
            </a>
        </li>
            @endif
            @if( Auth::user()->is_admin OR Auth::user()->id == $user->id )
        <li class="nav-item">
            <a class="nav-link {{ app('request')->input('tab') == 'user_user_alerts' ? 'active' : '' }}" href="#user_user_alerts" role="tab" data-toggle="tab">
                {{ trans('cruds.userAlert.title') }}
            </a>
        </li>
                @endif
    </ul>
    <div class="tab-content">
        <div class="tab-pane {{ app('request')->input('tab') == 'officer_disciplinaries' ? 'active' : '' }}" role="tabpanel" id="officer_disciplinaries">
            @includeIf('admin.users.relationships.officerDisciplinaries', [
                'disciplinaries' => $user->officerDisciplinaries,
                'pageName' => 'disciplinary',
                'crudName' => 'admin.disciplinaries.',
                'gateName' => 'disciplinary_'
                ])
        </div>
        <div class="tab-pane {{ app('request')->input('tab') == 'officer_comments' ? 'active' : '' }}" role="tabpanel" id="officer_comments">
            @includeIf('admin.users.relationships.officerComments', [
                'comments' => $user->officerComments,
                'pageName' => 'comment',
                'crudName' => 'admin.comments.',
                'gateName' => 'comment_'
                ])
        </div>
        <div class="tab-pane {{ app('request')->input('tab') == 'officer_training' ? 'active' : '' }}" role="tabpanel" id="officer_trainings">
            @includeIf('admin.users.relationships.officerTrainings', [
                'trainings' => $user->officerTrainings,
                'pageName' => 'training',
                'crudName' => 'admin.trainings.',
                'gateName' => 'training_'
                ])
        </div>
        <div class="tab-pane {{ app('request')->input('tab') == 'officer_sop_sign_offs' ? 'active' : '' }}" role="tabpanel" id="officer_sop_sign_offs">
            @includeIf('admin.users.relationships.officerSopSignOffs', [
                'sopSignOffs' => $user->officerSopSignOffs,
                'pageName' => 'sop',
                'crudName' => 'admin.sop-sign-offs.',
                'gateName' => 'sop_sign_off_'
                ])
        </div>
        <div class="tab-pane {{ app('request')->input('tab') == 'user_user_alerts' ? 'active' : '' }}" role="tabpanel" id="user_user_alerts">
            @includeIf('admin.users.relationships.userUserAlerts', [
                'userAlerts' => $user->userUserAlerts,
                'pageName' => 'alert',
                'crudName' => 'admin.user-alerts.',
                'gateName' => 'user_alerts_'
                ])
        </div>
    </div>
</div>
@endsection
