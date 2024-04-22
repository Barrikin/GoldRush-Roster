@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.training.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.trainings.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="officer_id">{{ trans('cruds.training.fields.officer') }}</label>
                <select class="form-control select2 {{ $errors->has('officer') ? 'is-invalid' : '' }}" name="officer_id" id="officer_id" required>
                    @foreach($officers as $id => $entry)
                        <option value="{{ $id }}" {{ old('officer_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('officer'))
                    <span class="text-danger">{{ $errors->first('officer') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.training.fields.officer_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="course_id">{{ trans('cruds.training.fields.course') }}</label>
                <select class="form-control select2 {{ $errors->has('course') ? 'is-invalid' : '' }}" name="course_id" id="course_id" required>
                    @foreach($courses as $id => $entry)
                        <option value="{{ $id }}" {{ old('course_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('course'))
                    <span class="text-danger">{{ $errors->first('course') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.training.fields.course_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('understood') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="understood" value="0">
                    <input class="form-check-input" type="checkbox" name="understood" id="understood" value="1" {{ old('understood', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="understood">{{ trans('cruds.training.fields.understood') }}</label>
                </div>
                @if($errors->has('understood'))
                    <span class="text-danger">{{ $errors->first('understood') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.training.fields.understood_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="understood_fto_id">{{ trans('cruds.training.fields.understood_fto') }}</label>
                <select class="form-control select2 {{ $errors->has('understood_fto') ? 'is-invalid' : '' }}" name="understood_fto_id" id="understood_fto_id">
                    @foreach($understood_ftos as $id => $entry)
                        <option value="{{ $id }}" {{ old('understood_fto_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('understood_fto'))
                    <span class="text-danger">{{ $errors->first('understood_fto') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.training.fields.understood_fto_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="understood_at">{{ trans('cruds.training.fields.understood_at') }}</label>
                <input class="form-control datetime {{ $errors->has('understood_at') ? 'is-invalid' : '' }}" type="text" name="understood_at" id="understood_at" value="{{ old('understood_at') }}">
                @if($errors->has('understood_at'))
                    <span class="text-danger">{{ $errors->first('understood_at') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.training.fields.understood_at_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('executed') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="executed" value="0">
                    <input class="form-check-input" type="checkbox" name="executed" id="executed" value="1" {{ old('executed', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="executed">{{ trans('cruds.training.fields.executed') }}</label>
                </div>
                @if($errors->has('executed'))
                    <span class="text-danger">{{ $errors->first('executed') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.training.fields.executed_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="executed_fto_id">{{ trans('cruds.training.fields.executed_fto') }}</label>
                <select class="form-control select2 {{ $errors->has('executed_fto') ? 'is-invalid' : '' }}" name="executed_fto_id" id="executed_fto_id">
                    @foreach($executed_ftos as $id => $entry)
                        <option value="{{ $id }}" {{ old('executed_fto_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('executed_fto'))
                    <span class="text-danger">{{ $errors->first('executed_fto') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.training.fields.executed_fto_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="executed_at">{{ trans('cruds.training.fields.executed_at') }}</label>
                <input class="form-control datetime {{ $errors->has('executed_at') ? 'is-invalid' : '' }}" type="text" name="executed_at" id="executed_at" value="{{ old('executed_at') }}">
                @if($errors->has('executed_at'))
                    <span class="text-danger">{{ $errors->first('executed_at') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.training.fields.executed_at_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="comments">{{ trans('cruds.training.fields.comments') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('comments') ? 'is-invalid' : '' }}" name="comments" id="comments">{!! old('comments') !!}</textarea>
                @if($errors->has('comments'))
                    <span class="text-danger">{{ $errors->first('comments') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.training.fields.comments_helper') }}</span>
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

@section('scripts')
<script>
    $(document).ready(function () {
  function SimpleUploadAdapter(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
      return {
        upload: function() {
          return loader.file
            .then(function (file) {
              return new Promise(function(resolve, reject) {
                // Init request
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '{{ route('admin.trainings.storeCKEditorImages') }}', true);
                xhr.setRequestHeader('x-csrf-token', window._token);
                xhr.setRequestHeader('Accept', 'application/json');
                xhr.responseType = 'json';

                // Init listeners
                var genericErrorText = `Couldn't upload file: ${ file.name }.`;
                xhr.addEventListener('error', function() { reject(genericErrorText) });
                xhr.addEventListener('abort', function() { reject() });
                xhr.addEventListener('load', function() {
                  var response = xhr.response;

                  if (!response || xhr.status !== 201) {
                    return reject(response && response.message ? `${genericErrorText}\n${xhr.status} ${response.message}` : `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`);
                  }

                  $('form').append('<input type="hidden" name="ck-media[]" value="' + response.id + '">');

                  resolve({ default: response.url });
                });

                if (xhr.upload) {
                  xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                      loader.uploadTotal = e.total;
                      loader.uploaded = e.loaded;
                    }
                  });
                }

                // Send request
                var data = new FormData();
                data.append('upload', file);
                data.append('crud_id', '{{ $training->id ?? 0 }}');
                xhr.send(data);
              });
            })
        }
      };
    }
  }

  var allEditors = document.querySelectorAll('.ckeditor');
  for (var i = 0; i < allEditors.length; ++i) {
    ClassicEditor.create(
      allEditors[i], {
        extraPlugins: [SimpleUploadAdapter]
      }
    );
  }
});
</script>

@endsection