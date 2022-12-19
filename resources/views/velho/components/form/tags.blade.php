@php
    $optional = optional($model)->{$name};
    $value = old($name, $optional !== null ? $optional->pluck('name')->join(',') : $optional);
    $value = is_array($value) ? join(',', $value) : $value;
@endphp

<div class="form-group date">
    @include('velho.components.form.label')

    @include('velho.components.form.prefix')

    <input type="{{ $type ?? 'text' }}"
           name="{{ $name }}"
           data-tags
           {{ isset($autofocus) ? 'autofocus' : '' }}
           value="{{ $value }}"
           id="{{ $name }}"
           class="form-control datetimepicker-input{{ $errors->has($name) ? ' is-invalid' : '' }}{{ isset($small) ? ' form-control-sm' : '' }}" />

    @include('velho.components.form.suffix')

    @include('velho.components.form.error-message')
</div>
