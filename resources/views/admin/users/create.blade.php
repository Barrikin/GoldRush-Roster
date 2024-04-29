@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('cruds.user.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.users.store") }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="required" for="call_sign">{{ trans('cruds.user.fields.call_sign') }}</label>
                    <input class="form-control {{ $errors->has('call_sign') ? 'is-invalid' : '' }}" type="text"
                           name="call_sign" id="call_sign" value="{{ old('call_sign', '') }}" required>
                    @if($errors->has('call_sign'))
                        <span class="text-danger">{{ $errors->first('call_sign') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.call_sign_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="name">{{ trans('cruds.user.fields.name') }}</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name"
                           id="name" value="{{ old('name', '') }}" required>
                    @if($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.name_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="badge">{{ trans('cruds.user.fields.badge') }}</label>
                    <input class="form-control {{ $errors->has('badge') ? 'is-invalid' : '' }}" type="text" name="badge"
                           id="badge" value="{{ old('badge', '') }}" step="1" required>
                    @if($errors->has('badge'))
                        <span class="text-danger">{{ $errors->first('badge') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.badge_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="rank_id">{{ trans('cruds.user.fields.rank') }}</label>
                    <select class="form-control select2 {{ $errors->has('rank') ? 'is-invalid' : '' }}" name="rank_id"
                            id="rank_id" required>
                        @foreach($ranks as $id => $entry)
                            <option value="{{ $id }}" {{ $entry == 'Cadet' ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('rank'))
                        <span class="text-danger">{{ $errors->first('rank') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.rank_helper') }}</span>
                </div>
                @can('administrator')
                    <div class="form-group">
                        <label for="roles">{{ trans('cruds.user.fields.roles') }}</label>
                        <div style="padding-bottom: 4px">
                            <span class="btn btn-info btn-xs select-all"
                                  style="border-radius: 0">{{ trans('global.select_all') }}</span>
                            <span class="btn btn-info btn-xs deselect-all"
                                  style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                        </div>
                        <select class="form-control select2 {{ $errors->has('roles') ? 'is-invalid' : '' }}"
                                name="roles[]" id="roles" multiple>
                            @foreach($roles as $id => $role)
                                <option
                                    value="{{ $id }}" {{ in_array($id, old('roles', [])) ? 'selected' : '' }}>{{ $role }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('roles'))
                            <span class="text-danger">{{ $errors->first('roles') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.roles_helper') }}</span>
                    </div>
                @endcan
                <div class="form-group">
                    <label for="certifications">{{ trans('cruds.user.fields.certifications') }}</label>
                    <div style="padding-bottom: 4px">
                        <span class="btn btn-info btn-xs select-all"
                              style="border-radius: 0">{{ trans('global.select_all') }}</span>
                        <span class="btn btn-info btn-xs deselect-all"
                              style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                    </div>
                    <select class="form-control select2 {{ $errors->has('certifications') ? 'is-invalid' : '' }}"
                            name="certifications[]" id="certifications" multiple>
                        @foreach($certifications as $id => $certification)
                            <option
                                value="{{ $id }}" {{ in_array($id, old('certifications', [])) ? 'selected' : '' }}>{{ $certification }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('certifications'))
                        <span class="text-danger">{{ $errors->first('certifications') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.certifications_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required">{{ trans('cruds.user.fields.status') }}</label>
                    <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status"
                            id="status" required>
                        <option value
                                disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach(App\Models\User::STATUS_SELECT as $key => $label)
                            <option
                                value="{{ $key }}" {{ old('status', '1') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('status'))
                        <span class="text-danger">{{ $errors->first('status') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.status_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="phone_number">{{ trans('cruds.user.fields.phone_number') }}</label>
                    <input class="form-control {{ $errors->has('phone_number') ? 'is-invalid' : '' }}" type="text"
                           name="phone_number" id="phone_number" value="{{ old('phone_number', '') }}" required>
                    @if($errors->has('phone_number'))
                        <span class="text-danger">{{ $errors->first('phone_number') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.phone_number_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="" for="hired_on">{{ trans('cruds.user.fields.hired_on') }}</label>
                    <input class="form-control date {{ $errors->has('hired_on') ? 'is-invalid' : '' }}" type="text"
                           name="hired_on" id="hired_on" value="{{ old('hired_on') }}">
                    @if($errors->has('hired_on'))
                        <span class="text-danger">{{ $errors->first('hired_on') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.hired_on_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="time_zone">{{ trans('cruds.user.fields.time_zone') }}</label>
                    {!! \Jackiedo\Timezonelist\Timezonelist::toSelectBox('time_zone', old('time_zone', ''), [
                        'class' => "form-control {{ $errors->has('time_zone') ? 'is-invalid' : '' }}",
                        'id'    => "time_zone",
                    ]) !!}

                    @if($errors->has('time_zone'))
                        <span class="text-danger">{{ $errors->first('time_zone') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.time_zone_helper') }}</span>
                </div>
                <!--<div class="form-group">
                <label class="required" for="password">{{ trans('cruds.user.fields.password') }}</label>
                <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password" name="password" id="password" required>
                @if($errors->has('password'))
                    <span class="text-danger">{{ $errors->first('password') }}</span>

                @endif
                <span class="help-block">{{ trans('cruds.user.fields.password_helper') }}</span>
            </div>-->
                <div class="form-group">
                    <button class="btn btn-danger" type="submit">
                        {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection
