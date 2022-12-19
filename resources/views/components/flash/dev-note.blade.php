@if (/*env('APP_DEBUG', false) === true &&*/ env('DEV_NOTES', false) === true)
    @dev
        <div class="alert alert-info">
            <strong>Nota de Dev:</strong> {{$message}}
        </div>
    @enddev
@endif