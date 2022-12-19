{{-- @permission('create ' . \Str::singular($wildcard)) --}}
    <a href="{{ route($wildcard . '.create', $params ?? []) }}" class="btn btn-success">{{$title ?? trans('actions.new')}}</a>
{{-- @endpermission --}}
