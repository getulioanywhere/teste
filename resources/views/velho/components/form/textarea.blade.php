@php
    $passname = $name;
    $name = isset($belongs) ? $belongs . '[' . $passname . ']' : $passname;
    $id = isset($belongs) ? $belongs . '.' . $passname : $passname;
@endphp

<div class="form-group">
    @include('velho.components.form.label')

    @include('velho.components.form.prefix')

    <textarea name="{{ $name }}"
        {{ isset($autofocus) ? 'autofocus' : '' }}
        id="{{ $name }}"
        rows="{{ $height ?? 5 }}"
        {{ isset($editor) ? 'data-editor' : '' }}
        {{ isset($editor) ? 'data-upload-url="' . url('/admin/editor/upload') . '"' : '' }}
        class="form-control{{ $errors->has($id) ? ' is-invalid' : '' }}"
        {{ isset($maxlength) ? 'maxlength='.$maxlength : ''}}
        @if(isset($required) && $required)
            required
        @endisset
    >{{ isset($value) && !$value ? '' : old($id, optional($model)->{$passname}) }}</textarea>

    @include('velho.components.form.suffix')

    @include('velho.components.form.error-message', ['name' => $id])
</div>
