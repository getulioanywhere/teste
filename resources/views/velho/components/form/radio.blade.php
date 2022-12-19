<div class="form-group">
    @include('velho.components.form.label')

    @foreach($options as $option)
        <div>
            <input type="radio" name="{{$name}}" value="{{$option->id}}" id="{{ $name }}-{{ $option->id }}"
                @if (isset($checked) && $checked === $option->id) checked @endif
            >
            <label class="font-weight-normal" for="{{ $name }}-{{ $option->id }}">
                {{($option->{$optionLabel})}}
            </label>
        </div>
    @endforeach

    @include('velho.components.form.prefix')
    @include('velho.components.form.error-message')
</div>