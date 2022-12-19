@extends('masterpage.master')

@section('content')
<!-- open form -->

<x-form action="{{  $route }}" method="POST" enctype="true">

    <!-- button opne modal -->
    <x-button :array="[
              ['modal'=>'confirm-save', 'text'=>'Salvar'],
              ['onclick'=>'history.back();', 'text'=>'Voltar', 'bgcolor'=>'bg-gradient-secondary'],             
              ]">                  
    </x-button>

    <!-- open tab -->
    <x-tab :titlestr="$title" :namestr="$namestr">
        <x-slot name="nav">
            <!-- headers tab menu nav -->
            <x-tab-list-nav id="page" title="Página" active="active" selected="true"></x-tab-list-nav>
            <x-tab-list-nav id="body-page" title="Corpo da página" ></x-tab-list-nav>
            <x-tab-list-nav id="modal-page" title="Modal de confirmação" ></x-tab-list-nav>
        </x-slot>

        <x-slot name="content">
            <!-- open content tab -->
            <x-tab-content id="page" active="active">

                <div class="row">
                    <div class="col-md-4">                        
                        <x-input 
                            type="text" 
                            id="title"
                            name="page_title"
                            placeholder="Título da Página"
                            label="Título da Página"
                            icon="<i class = 'fas fa-envelope'></i>" 
                            :value="$data">
                        </x-input>                        
                    </div> 

                    <div class="col-md-4">                        
                        <x-input 
                            type="text" 
                            id="title"
                            name="slug"
                            placeholder="Título da Página"
                            label="URL da Página"
                            icon="<i class = 'fas fa-envelope'></i>" 
                            :value="$data">
                        </x-input>                        
                    </div> 
                    
                    <div class="col-md-4">

                        <x-radio-button 
                            name="page_active" 
                            label="Status" 
                            labela="Ativo" 
                            labelb="Inativo" 
                            :value="$data">
                        </x-radio-button>

                    </div> 

                </div>



            </x-tab-content>

            <x-tab-content id="body-page">
                <div class="row">
                    <div class="col-md-12"> 
                        <x-text-area 
                            name="page_body"
                            label="Corpo da Página"
                            :value="$data" >
                                
                        </x-text-area>
                    </div>

                </div>
            </x-tab-content>

            <x-tab-content id="modal-page">
                <div class="row">
                    <div class="col-md-6">                        
                        <x-input 
                            type="text" 
                            id="title"
                            name="modal_title"
                            placeholder="Título da Modal de Cookie"
                            label="Título da Página"
                            icon="<i class = 'fas fa-envelope'></i>" 
                            :value="$data">
                        </x-input>                        
                    </div> 
                    </div> 
                <div class="row">

                    <div class="col-md-12">  
                        <x-text-area 
                            name="modal_body"
                            label="Corpo da Modal de Cookies"                              
                            :value="$data">
                        </x-text-area>                                           
                    </div> 

                </div>
            </x-tab-content>

        </x-slot> 

    </x-tab>


    <!-- Modal confirm and modal message -->
    <x-modal></x-modal>

</x-form>
<!-- close form -->

@endsection
