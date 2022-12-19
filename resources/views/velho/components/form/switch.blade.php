@if(isset($boxed) && $boxed)
    <div class="p-3 border rounded bg-light mb-2">
@endif
        <div class="form-group">
            @include('velho.components.form.label')

            @isset($details)
                <div class="instruction">{{$details}}</div>
            @endisset

            <div>
                <input
                    type="checkbox"
                    value="{{$value ?? '1'}}"
                    data-switch
                    name="{{ $name }}"
                    {{ (isset($checked) && $checked && !old('_token') && !isset($model->{$name})) || old($name, optional($model)->{$name}) ? 'checked' : '' }}
                    {{-- checked="{{$forceChecked ?? ''}}" --}}
                    {{isset($forceChecked) && $forceChecked ? 'checked' : ''}}
                    id="{{ $name }}"
                    {{ isset($toggleVisibility) ? 'data-toggle-visibility=' . $toggleVisibility : '' }}
                    data-on="{{--@lang('admin.words.yes')--}}Sim"
                    data-off="{{--@lang('admin.words.no')--}}Não"
                    data-size="{{ isset($small) ? 'small' : 'normal' }}"
                    onchange="{{$onChange ?? '' }}"
                    {{ isset($disabled) && $disabled ? 'disabled' : '' }}
                    {{ isset($readonly) && $readonly ? 'readonly' : '' }}
                />
            </div>
        </div>
@if(isset($boxed) && $boxed)
    </div>
@endif

    {{-- @php
        $checkedA = '';
        $checkedB = '';
    @endphp
    @if(isset($model->active) )
        @if($model->active === 1)
            @php
                $checkedA = 'checked';
                $checkedB = '';
            @endphp
        @else
            @php
                $checkedA = '';
                $checkedB = 'checked';
            @endphp
        @endif
    @endif
    <div class="form-check">
        <input class="form-check-input" name="{{ $name }}" value="{{$model->active}}" type="radio" name="flexRadioDefault" id="flexRadioDefault1" {{$checkedA}}>
        <label class="form-check-label" for="flexRadioDefault1">
            Sim
        </label>
    </div>

    <div class="form-check">
        <input class="form-check-input" name="{{ $name }}" value="{{$model->active}}" type="radio" name="flexRadioDefault" id="flexRadioDefault2" {{$checkedB}}>
        <label class="form-check-label" for="flexRadioDefault2">
            Não
        </label>
    </div>

</div> --}}
