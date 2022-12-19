<div class="row section px-3" style="{{isset($hidden) && $hidden ? 'display:none': ''}}" {{isset($id) ? 'id='.$id : ''}}>
    <div class="col-lg-3 col-md-3 col-sm-12">
        <h5 class="{{isset($required) && $required ? 'required' : ''}}">{{$title ?? 'Seção'}}</h5>
        @if(isset($description) && $description)
            <p class="text-secondary">{{$description ?? ''}}</p>
        @endif
    </div>
    <div class="col-lg-9 col-md-9 col-sm-12">
        {{ $slot }}
    </div>
</div>
