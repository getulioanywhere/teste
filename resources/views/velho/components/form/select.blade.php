<div class="form-group">
    @include('velho.components.form.label')

    @include('velho.components.form.prefix')

    <select name="{{ $name }}"
            {{ isset($autofocus) ? 'autofocus' : '' }}
            id="{{ $name }}"
            data-value="{{ $model ? old($name, $model->{$comparableKey ?? $name}) : '' }}"
            class="form-control{{ $errors->has($name) ? ' is-invalid' : '' }}{{ isset($small) ? ' form-control-sm' : '' }}{{ count($options) ? '' : ' disabled' }}">
        @if (!isset($required) || isset($empty))
            <option value="">- @lang('actions.choose') -</option>
        @endif
        
        @if (isset($isState))
            @foreach ($states->all() as $state)
                <option value="{{$state['id']}}" {{ isset($model) && $state['id'] === $model->state_id ? ' selected' : '' }}>{{$state['name']}}</option>
            @endforeach
        @else
            @foreach ($options as $value => $option)
                <option value="{{ $value }}"{{ $model && $model->{$comparableKey ?? $name} === $value ? ' selected' : '' }}>{{ $option }}</option>
            @endforeach
        @endif
    </select>

    @include('velho.components.form.suffix')

    @include('velho.components.form.error-message')
</div>
