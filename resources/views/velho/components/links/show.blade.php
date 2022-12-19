{{-- @permission('show ' . \Str::singular($wildcard)) --}}
    <a href="{{ route('admin.' . $wildcard . '.show', $params ?? $record->id) }}" class="btn btn-secondary btn-sm">{{$title ?? trans('actions.view')}}</a>
{{-- @endpermission --}}
