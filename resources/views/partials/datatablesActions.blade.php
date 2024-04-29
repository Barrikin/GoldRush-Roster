@can($gateName.'show')
    <a class="btn btn-xs btn-primary" href="{{ route($crudName.'show', $model->id) }}">
        {{ trans('global.view') }}
    </a>
@endcan
@can($gateName.'edit')
    @if (Gate::allows('administrator') || Auth::user()->rank->rank_order < $model->rank->rank_order)
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
        @if (Gate::allows('administrator') || Auth::user()->rank->rank_order < $model->rank->rank_order)
            <form action="{{ route($crudName.'destroy', $model->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
            </form>
        @endif
    @endif
@endcan
