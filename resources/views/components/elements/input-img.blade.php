@if($value)
    @php
        $img = 'src=' .asset('storage/' . $value);
    @endphp
@endif
<style>
    .preview-img
    {
        width: 150px;
        height: 150px;
        border: 1px solid #bebebe;
        background-color:#fff; 
    }
    img.preview-img {
        object-fit: contain;
    }
</style>

<div class="teste">
    <div class="form-group">
        <div class="d-flex flex-column">
            <label for="preview-img">
                {{$labelTextfield}}
            </label>
            <img class="preview-img rounded" 
                 id="preview-img"
                 data-name-img=""
                 {{isset($img) ? $img : ''}}>
        </div>
        <input name="{{$name.'_link'}}" type="hidden" id="linkimg" value="">
    </div>                                  
    <div class="form-group d-flex flex-row">
        <input class="file-button" type="button" value="{{$buttonTextfield}}">
        <input  id="imagem01" class="file-chooser" type="file" accept="image/*" style="display:none;" name="{{$name}}">
        <input class="media-delete" type="button" id="deletar1" value="Deletar" style="display: none;">
    </div>
</div>