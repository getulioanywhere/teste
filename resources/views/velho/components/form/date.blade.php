@php
    $value = old($name, optional($model)->{$name});
@endphp

<div class="form-group date">
    @include('velho.components.form.label')

    @include('velho.components.form.prefix')

    <input type="date"
           name="{{ $name }}"
           value="{{ $value }}"
           id="{{ $name }}"
           class="form-control {{ $errors->has($name) ? ' is-invalid' : '' }}{{ isset($small) ? ' form-control-sm' : '' }}"/>

    @include('velho.components.form.suffix')

    @include('velho.components.form.error-message')
</div>
