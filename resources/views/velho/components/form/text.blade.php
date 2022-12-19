
@php
    $keyName = isset($keyName) ? $keyName : $name;
    $passname = $name;
    $name = isset($belongs) ? $belongs . '[' . $passname . ']' : $passname;
    $id = isset($belongs) ? $belongs . '.' . $passname : $passname;
    $disabled = (isset($disabled) && $disabled);
    $readonly = (isset($readonly) && $readonly);
@endphp

<div class="form-group">
    @include('velho.components.form.label', ['name' => str_replace('.', '-', $id) ])

    @include('velho.components.form.prefix')

    @isset($multiple)
        @php
            $total = $model && $model->{$name} ? count($model->{$name}) : 0;
        @endphp

        @for($i = 0; $i <= $total; $i++)
            <input type="{{ $type ?? 'text' }}"
                   name="{{ $name }}[]"
                   {{ isset($autofocus) ? 'autofocus' : '' }}
                   value="{{ $model && isset($model->{$name}[$i]) ? is_object($model->{$name}[$i]) ? $model->{$name}[$i]->{$keyName} : $model->{$name}[$i] : null }}"
                   id="{{ $name }}"
                   class="mb-2 form-control{{ $errors->has($name) ? ' is-invalid' : '' }}{{ isset($small) ? ' form-control-sm' : '' }}" />
        @endfor

        <div class="repeatable-container" data-template="#field-{{ $name }}" data-add-trigger=".add-field-{{ $name }}"></div>

        <div class="text-right">
            <a href="#" class="btn btn-sm btn-success add-field-{{ $name }}">@lang('actions.add')</a>
        </div>

        <script type="text/template" id="field-{{ $name }}">
            <input type="{{ $type ?? 'text' }}"
                   name="{{ $name }}[]"
                   id="{{ $name }}-{?}"
                   class="mb-2 form-control{{ isset($small) ? ' form-control-sm' : '' }}"
                   {{ $disabled ? 'disabled' : '' }}
                   {{ $readonly ? 'readonly' : '' }}
            />
        </script>
    @else

    @if(isset($addOn))

        <div class="input-group">
    @endif

    @if(isset($addOn))
        <div class="input-group-prepend">
            <span class="input-group-text d-flex flex-direction-column">
                {!!$addOn['limit']!!}
            </span>
        </div>
    @endif

    <input type="{{ $type ?? 'text' }}"
            name="{{ $name }}"
            {{ isset($autofocus) ? 'autofocus' : '' }}
            @if(!isset($noValue))
                value="{{ isset($model->{$keyName}) && !isset($value) ? $model->{$keyName} : (isset($value) && !$model ? $value : old($id, optional($model)->{$passname})) }}"
            @endif
            id="{{ str_replace('.', '-', $id) }}"
            class="form-control{{ $errors->has($id) ? ' is-invalid' : '' }}{{ isset($small) ? ' form-control-sm' : '' }}"
            {{ $disabled ? 'disabled' : '' }}
            {{ $readonly ? 'readonly' : '' }}
            {{ isset($maxlength) ? 'maxlength='.$maxlength : ''}}
            @isset($mask)
                onchange="$(this).mask('{{$mask}}');"
                onkeypress="$(this).mask('{{$mask}}');"
            @endisset

            @isset($min)
                min="{{$min}}"
            @endisset
        />

        
    @if(isset($addOn))
        </div>
        <span>{!! $addOn['current'] !!}</small>
        <hr class="my-0">
        <span>{!! $addOn['used'] !!}</small>
    @endif
        
    @endisset

    @include('velho.components.form.suffix')

    @include('velho.components.form.error-message', ['name' => $id])
</div>
