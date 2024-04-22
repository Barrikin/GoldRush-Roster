@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.sopSignOff.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.sop-sign-offs.update", [$sopSignOff->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="officer_id">{{ trans('cruds.sopSignOff.fields.officer') }}</label>
                <select class="form-control select2 {{ $errors->has('officer') ? 'is-invalid' : '' }}" name="officer_id" id="officer_id" required>
                    @foreach($officers as $id => $entry)
                        <option value="{{ $id }}" {{ (old('officer_id') ? old('officer_id') : $sopSignOff->officer->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('officer'))
                    <span class="text-danger">{{ $errors->first('officer') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.sopSignOff.fields.officer_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="sop_id">{{ trans('cruds.sopSignOff.fields.sop') }}</label>
                <select class="form-control select2 {{ $errors->has('sop') ? 'is-invalid' : '' }}" name="sop_id" id="sop_id" required>
                    @foreach($sops as $id => $entry)
                        <option value="{{ $id }}" {{ (old('sop_id') ? old('sop_id') : $sopSignOff->sop->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('sop'))
                    <span class="text-danger">{{ $errors->first('sop') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.sopSignOff.fields.sop_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="signed_off_at">{{ trans('cruds.sopSignOff.fields.signed_off_at') }}</label>
                <input class="form-control datetime {{ $errors->has('signed_off_at') ? 'is-invalid' : '' }}" type="text" name="signed_off_at" id="signed_off_at" value="{{ old('signed_off_at', $sopSignOff->signed_off_at) }}">
                @if($errors->has('signed_off_at'))
                    <span class="text-danger">{{ $errors->first('signed_off_at') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.sopSignOff.fields.signed_off_at_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection