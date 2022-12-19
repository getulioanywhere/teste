<div class="form-group">
    @if(isset($label))
    <label for="summernote">
        {{$label}}
    </label>
    @endif
    
    
    
    <textarea class="{{$class}}" name="{{$name}}" rows="{{$rows}}" cols="{{$cols}}">
                {{ $value }}
    </textarea>
</div>