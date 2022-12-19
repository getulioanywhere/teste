@extends('masterpage.master')

@section('content')
<!-- Main content -->

{{-- 
    @lang($title)
    {{$data->name}}
--}}
<x-form :array="['action'=>'teste', 'method'=>'post']">
<section class="content">
    <div class="container-fluid">     

        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-edit"></i>
                    @lang($title)
                </h3>
            </div>

            <div class="card-body">
                <h4>{{$data->name}}</h4>

                <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">

                    <li class="nav-item">
                        <a class="nav-link active" 
                           id="custom-content-below-home-tab" 
                           data-toggle="pill" 
                           href="#custom-content-below-home" 
                           role="tab" 
                           aria-controls="custom-content-below-home" 
                           aria-selected="true">
                            Dados
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" 
                           id="custom-content-below-profile-tab" 
                           data-toggle="pill" 
                           href="#custom-content-below-profile" 
                           role="tab" 
                           aria-controls="custom-content-below-profile" 
                           aria-selected="false">
                            Avatar
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" 
                           id="custom-content-below-messages-tab" 
                           data-toggle="pill" 
                           href="#custom-content-below-messages" 
                           role="tab" 
                           aria-controls="custom-content-below-messages" 
                           aria-selected="false">
                            Grupos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" 
                           id="custom-content-below-settings-tab" 
                           data-toggle="pill" 
                           href="#custom-content-below-settings" 
                           role="tab" 
                           aria-controls="custom-content-below-settings" 
                           aria-selected="false">
                            Status
                        </a>
                    </li>

                </ul>

                <div class="tab-content" id="custom-content-below-tabContent">
                    
                    
                        
                    


                    <div 
                        class="tab-pane fade show active" 
                        id="custom-content-below-home" 
                        role="tabpanel" 
                        aria-labelledby="custom-content-below-home-tab">
                        
                        Nome {{$data->name}}
                        Email {{$data->email}}
                    </div>

                    <div 
                        class="tab-pane fade" 
                        id="custom-content-below-profile" 
                        role="tabpanel" 
                        aria-labelledby="custom-content-below-profile-tab">


                        <div class="row">
                            <div class="col-md-6">
                                @include('components.elements.input', 
                                [
                                'type'=>'email',
                                'icon'=>'<i class = "fas fa-envelope"></i>',
                                'placeholder'=>'login email',
                                'label'=>'E-mail'
                                ]
                                )
                            </div>                            
                        </div>
                       
                        

                        <div 
                            class="tab-pane fade" 
                            id="custom-content-below-messages" 
                            role="tabpanel" 
                            aria-labelledby="custom-content-below-messages-tab">
                            Grupos {{$data->super_user}}
                        </div>

                        <div 
                            class="tab-pane fade" 
                            id="custom-content-below-settings" 
                            role="tabpanel" 
                            aria-labelledby="custom-content-below-settings-tab">
                            Status {{$data->active}}
                        </div>

                    </div>
                </div>
               
                
                
            </div>
        </div>
</section>
</x-form>  









@endsection
