@isset($label)
    <label class="form-control-label" for="{{ str_replace('.', '-', $name) }} @if (isset($required) && $required) required @endif">
        {{ $label }}

        @if (isset($required) && $required)
            <span class="required"></span>
        @endif
    </label>
@endisset