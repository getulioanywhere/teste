<div>

    <div class="form-group">
        <label for="exampleSelectBorder-{{$id}}">
            @if(isset($label))
            {{$label}} {{$idvalue}}
            @endif
        </label>
        <select name="{{ encrypt($name) }}" class="custom-select" id="exampleSelectBorder-{{$id}}">

            <option>Selecione</option>
            
           {!! $options !!}

        </select>
    </div>
</div>