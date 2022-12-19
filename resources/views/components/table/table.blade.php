<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <div class="card">
                    {{--<div class="card-header">
                        <h3 class="card-title">
                            @lang($wildcard)
                        </h3>
                    </div>--}}
                    @if(isset($routeCreate))
                    @php
                    $array = isset($routeCreate) ? \App\Classes\Functions::checkButtonsExists($routeCreate) : null;
                    @endphp
                    @if(isset($array) && count($array) > 0)                    
                    <x-button :array="$array"></x-button>
                    @endif
                    @endif
                    
                    @if(isset($button) && count($button) > 0)                      
                    <x-button :array="$button"></x-button>
                    @endif


                    <div class="card-body">
                        {{--@if(isset($data))--}}
                        @php 
                        $model = $data['data'];
                        $columns = $data['columns'];
                        $module = $data['module'];
                        $idTable = @encrypt(time());
                        @endphp
                        <table id="example1-{{$idTable}}" class="table table-bordered table-striped datatables" data-url="{{$routeAjax}}">
                            <thead>
                                <tr>
                                    @foreach($columns as $column) 
                                    
                                        @switch($column)
                                            @case('Editar')
                                                <th data-orderable="false">{{ $column }}</th>
                                            @break
                                            @case('Deletar')
                                                <th data-orderable="false">{{ $column }}</th>
                                            @break
                                            @default
                                                <th>{{ $column }}</th>
                                        @endswitch                                    
                                    
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody> 


                                @for ($i = 0; $i < count($model); $i++)
                                @php                                        
                                $id = @encrypt($model[$i]['ID'])
                                @endphp
                                <tr id="row-id-{{ $id }}">
                                    @foreach ($model[$i] as $keyM => $value)
                                    <td>                                        
                                        @if(\App\Classes\Functions::isFileImg($value) === false)
                                        
                                        @if($keyM === 'STATUS' || $keyM === 'Status')
                                            @lang(\App\Classes\Functions::statusInTable($value))
                                        @else
                                            {{ \App\Classes\Functions::convertDate($value)}}
                                        @endif
                                        
                                        @else
                                        <link rel="preload" href="{{ asset('storage/' .$value) }}" as="image">
                                        <img src="{{ asset('storage/' .$value) }}" class="img-circle img-fluid" style="height: 100px; width: 100px;" alt="User"/> 


                                        @endif
                                    </td>
                                    @endforeach

                                    @foreach($columns as $key=> $column) 

                                    @switch($column)
                                    @case('Editar')
                                    <td>
                                        <a href="{{ route(config($routeEdit), $id) }}">
                                            <link rel="preload" href="{{asset('img/icons/Pencil3.ico')}}" as="image">
                                            <img style="height:30px; 
                                                 width:30px;" 
                                                 class="img-fluid" 
                                                 src="{{asset('img/icons/Pencil3.ico')}}" 
                                                 title="Editar">
                                        </a>
                                    </td>
                                    @break

                                    @case('Deletar')
                                    <td>
                            <x-form 
                                action="{{ route(config($routeDestroy), $id)}}" 
                                method="POST">

                                <button data-toggle="modal" 
                                        data-target="#modal-confirm-save{{ $id }}"
                                        name="btn-click-destroy" 
                                        type="button" >
                                    Deletar
                                </button>
                                <!-- Modal confirm and modal message -->
                                <x-modal id="{{ $id }}"></x-modal>
                            </x-form>
                            </td>
                            @break
                            @endswitch
                            @endforeach

                            </tr>
                            @endfor

                            </tbody>

                            <tfoot>
                                <tr>
                                    @foreach($columns as $column) 
                                        @switch($column)
                                            @case('Editar')
                                                <th data-orderable="false">{{ $column }}</th>
                                            @break
                                            @case('Deletar')
                                                <th data-orderable="false">{{ $column }}</th>
                                            @break
                                            @default
                                                <th>{{ $column }}</th>
                                        @endswitch     
                                    @endforeach
                                </tr>
                            </tfoot>

                        </table>

                       {{-- @else
                        <div>
                            <b>
                                @lang('table.no-data')
                            </b>
                        </div>
                        @endif--}}
                    </div>

                </div>               
            </div>           
        </div>       
    </div>   
</section>               
