<div class="card-footer">
    <div class="row">
        <div class="col-md-12">
            @if(isset($array)) 
           
                @for ($i = 0; $i < count($array); $i++) 
                
                    @if(!is_null($array[$i]))
                        @php

                            $obj = (object)$array[$i];

                            $bgcolor = isset($obj->bgcolor) ? $obj->bgcolor : 'bg-gradient-success';
                            $modal = isset($obj->modal) ? 'data-toggle=modal data-target=#modal-'.$obj->modal : '';

                            $text = isset($obj->text) ? $obj->text : '';

                            $onclick = isset($obj->onclick) ? 'onclick = '.$obj->onclick : '';
                            $onclick .= isset($obj->locationhref) ? "onclick = location.href='".$obj->locationhref."'" : '';

                        @endphp

                        <div class="btn-group">                
                            <button type="button" 
                                    class="btn btn-block {{$bgcolor}}" {{$modal}} {{ $onclick }}>
                                {!! isset($obj->icon) ? '<i class="'.$obj->icon.'"></i>' : '' !!}
                                {{$text}}
                            </button>                
                        </div>
                    @endif
                
                @endfor  
            
            @else
            
                <div class="btn-group">                
                    <button type="button" 
                            class="btn btn-block bg-success" 
                            data-toggle="modal"
                            data-target="#modal-confirm-save">
                        <i class="fas fa-save"></i>
                        Salvar
                    </button>                
                </div>
            
            
            @endif

        </div>
    </div>
</div>

