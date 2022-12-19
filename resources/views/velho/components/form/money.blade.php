@php
    $value = old($name, optional($model)->{$name});
@endphp

<div class="form-group date">
    @include('velho.components.form.label')

    @include('velho.components.form.prefix')

    <input type="{{ $type ?? 'text' }}"
           name="{{ $name }}"
           data-mask-money
           {{ isset($autofocus) ? 'autofocus' : '' }}
           value="{{ $value ? number_format(to_float($value), 2, ',', '.') : $value }}"
           id="{{ $name }}"
           class="form-control {{ $errors->has($name) ? ' is-invalid' : '' }}{{ isset($small) ? ' form-control-sm' : '' }}" />

    @include('velho.components.form.suffix')

    @include('velho.components.form.error-message')
</div>
