{{-- @permission('destroy ' . \Str::singular($wildcard)) --}}
    <button data-href="{{ route($wildcard . '.destroy', $record->id) }}" data-delete class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
{{-- @endpermission --}}
