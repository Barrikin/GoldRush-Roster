@can($gateName.'show')
    <a class="btn btn-xs btn-primary" href="{{ route($crudName.'show', $model->id) }}">
        {{ trans('global.view') }}
    </a>
@endcan
@can($gateName.'edit')
    @if($crudName == 'admin.users.')
        @if($user && Gate::allows('administrator') || Auth::user()->rank->rank_order < $model->rank->rank_order)
            <a class="btn btn-xs btn-info" href="{{ route($crudName.'edit', $model->id) }}">
                {{ trans('global.edit') }}
            </a>
        @endif
    @else
        <a class="btn btn-xs btn-info" href="{{ route($crudName.'edit', $model->id) }}">
            {{ trans('global.edit') }}
        </a>
    @endif

@endcan
@can($gateName.'delete')
    @if($model->trashed())
        @can('trash.restore')
        <form action="{{ route($crudName.'restore', $model->id) }}" method="POST" style="display: inline-block;">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="user_id" value="{{ $model->id }}">
            <input type="submit" class="btn btn-xs btn-success" value="{{ trans('global.restore') }}">
        </form>
        @endcan
        @can('trash.delete')
        <form action="{{ route($crudName.'forcedestroy', $model->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="user_id" value="{{ $model->id }}">
            <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.permadel') }}">
        </form>
        @endcan
    @else
        @if($crudName == 'admin.users.')
            @if(Gate::allows('administrator') || Auth::user()->rank->rank_order < $model->rank->rank_order)
            <form action="{{ route($crudName.'destroy', $model->id) }}" method="POST" onsubmit="delete_submit('resignation', {{$user->id}}); return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="delete_type" value="resignation">
                <input type="hidden" id="resignation{{$user->id}}" name="delete_reason" value="test">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.resigned') }}">
            </form>
            <form action="{{ route($crudName.'destroy', $model->id) }}" method="POST" onsubmit="delete_submit('termination', {{$user->id}}); return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="delete_type" value="termination">
                <input type="hidden" id="termination{{$user->id}}" name="delete_reason" value="">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.terminate') }}">
            </form>
                @endif
        @else
            <form action="{{ route($crudName.'destroy', $model->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
            </form>
            @endif
    @endif
@endcan
<script>
    function delete_submit(type, id) {
        document.getElementById(type+id).value = prompt("Reason for "+type+"?");
    }
</script>
