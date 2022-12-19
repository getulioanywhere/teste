<div class="form-group">

    @if($label)
    <label 
        for="exampleInputEmail1">
        {{$label}}
    </label>
    @endif

    <div class = "input-group mb-3">

        @if($icon)
            <div class = "input-group-prepend">
                <span class = "input-group-text">
                    {!! $icon !!}
                </span>
            </div>
        @endif 

        <input 
            name="{{ $name }}"
            id="{{ $id }}"
            type = "{{ $type  }}" 
            class = "form-control {{ $class }}"                
            placeholder = "{{ $placeholder  }}"
            value = "{{ $value  }}"
            >

    </div>
</div>