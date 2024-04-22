@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.disciplinary.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.disciplinaries.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="officer_id">{{ trans('cruds.disciplinary.fields.officer') }}</label>
                <select class="form-control select2 {{ $errors->has('officer') ? 'is-invalid' : '' }}" name="officer_id" id="officer_id" required>
                    @foreach($officers as $id => $entry)
                        <option value="{{ $id }}" {{ old('officer_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('officer'))
                    <span class="text-danger">{{ $errors->first('officer') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.disciplinary.fields.officer_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.disciplinary.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', '') }}" required>
                @if($errors->has('title'))
                    <span class="text-danger">{{ $errors->first('title') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.disciplinary.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="comment">{{ trans('cruds.disciplinary.fields.comment') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('comment') ? 'is-invalid' : '' }}" name="comment" id="comment">{!! old('comment') !!}</textarea>
                @if($errors->has('comment'))
                    <span class="text-danger">{{ $errors->first('comment') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.disciplinary.fields.comment_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="points">{{ trans('cruds.disciplinary.fields.points') }}</label>
                <input class="form-control {{ $errors->has('points') ? 'is-invalid' : '' }}" type="number" name="points" id="points" value="{{ old('points', '0') }}" step="1" required>
                @if($errors->has('points'))
                    <span class="text-danger">{{ $errors->first('points') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.disciplinary.fields.points_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="issued_by_id">{{ trans('cruds.disciplinary.fields.issued_by') }}</label>
                <select class="form-control select2 {{ $errors->has('issued_by') ? 'is-invalid' : '' }}" name="issued_by_id" id="issued_by_id" required>
                    @foreach($issued_bies as $id => $entry)
                        <option value="{{ $id }}" {{ old('issued_by_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('issued_by'))
                    <span class="text-danger">{{ $errors->first('issued_by') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.disciplinary.fields.issued_by_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="expire_at">{{ trans('cruds.disciplinary.fields.expire_at') }}</label>
                <input class="form-control datetime {{ $errors->has('expire_at') ? 'is-invalid' : '' }}" type="text" name="expire_at" id="expire_at" value="{{ old('expire_at') }}" required>
                @if($errors->has('expire_at'))
                    <span class="text-danger">{{ $errors->first('expire_at') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.disciplinary.fields.expire_at_helper') }}</span>
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
                xhr.open('POST', '{{ route('admin.disciplinaries.storeCKEditorImages') }}', true);
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
                data.append('crud_id', '{{ $disciplinary->id ?? 0 }}');
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