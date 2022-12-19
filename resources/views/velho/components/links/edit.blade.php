{{-- @permission('edit ' . \Str::singular($wildcard)) --}}
    <a href="{{ route($wildcard . '.edit', $params ?? $record->id) }}" class="btn btn-sm btn-default">{{$title ?? trans('actions.edit')}}</a>
{{-- @endpermission --}}
