@php
$methodPPD = $method !== 'get' || $method !== 'post' ? $method : '';
@endphp
<form  
    @if(isset($action))
        action="{{ $action }}" 
    @endif

    @if(isset($method))
        method="{{ $method }}"
    @endif

    @if(isset($id))
        id="{{ $id }}"
    @endif
    
    @if(isset($enctype))
        enctype="multipart/form-data"
    @endif

    name="formname">

    @csrf
    @if(!empty($methodPPD))
        @method($methodPPD)
    @endif
    
    {{$slot}}
    
</form>