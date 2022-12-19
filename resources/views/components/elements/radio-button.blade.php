<div class="form-group">

    @if(isset($label))
    <label 
        for="exampleInputEmail1">
        {{$label}}
    </label>
    @endif
    @php
    $name = encrypt($name);
    @endphp

    <div class="custom-control custom-radio">
        <input 
            class="custom-control-input" 
            type="radio" 
            id="customRadio1"
            value="1"
            name="{{ $name }}"
            {{ ($value === 1) ? 'checked' : '' }}>

        <label 
            for="customRadio1" 
            class="custom-control-label">
            {{ $labela }}
        </label>
    </div>
    <div class="custom-control custom-radio">
        <input 
            class="custom-control-input"            
            type="radio" 
            id="customRadio2"
            value="0"
            name="{{ $name }}"
            {{ ($value === 0) ? 'checked' : '' }}>

        <label for="customRadio2" class="custom-control-label">
            {{$labelb}}
        </label>
    </div>
</div>