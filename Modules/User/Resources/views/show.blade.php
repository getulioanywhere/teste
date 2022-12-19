@extends('masterpage.master')

@section('content')

<!-- open form -->
<x-form action="{{  $route }}" method="POST" enctype="true">


    <!-- button opne modal -->
    <x-button :array="[
              ['modal'=>'confirm-save', 'text'=>'Salvar'],
              ['onclick'=>'history.back();', 'text'=>'Voltar', 'bgcolor'=>'bg-gradient-secondary'],
              ['locationhref'=>$routeCreate, 'text'=>'Cadastrar Novo', 'bgcolor'=>'bg-gradient-primary']

              ]">                  
    </x-button>

    <!-- open tab -->
    <x-tab :titlestr="$title" :namestr="$namestr">
        <x-slot name="nav">
            <!-- headers tab menu nav -->
            <x-tab-list-nav id="dados" title="Dados" active="active" selected="true"></x-tab-list-nav>
            <x-tab-list-nav id="avatar" title="Avatar"></x-tab-list-nav>
            <x-tab-list-nav id="grupos" title="Grupos"></x-tab-list-nav>
            <x-tab-list-nav id="status" title="Status"></x-tab-list-nav>
            <x-tab-list-nav id="password" title="Senha"></x-tab-list-nav>

        </x-slot>

        <x-slot name="content">
            <!-- open content tab -->

            <x-tab-content id="dados" active="active">

                <div class="row">
                    <div class="col-md-6">

                        <!-- open input -->
                        <x-input 
                            type="text" 
                            id="usuer"
                            name="name"
                            icon="<i class = 'fas fa-envelope'></i>" 
                            placeholder="Nome do Usuário"
                            label="Nome do usuário"
                            :value="$data">
                        </x-input>                        
                        <!-- open input -->

                    </div> 
                </div>

                <div class="row">
                    <div class="col-md-6">

                        <x-input 
                            type="email" 
                            id="email"
                            name="email"
                            icon="<i class = 'fas fa-envelope'></i>" 
                            placeholder="login email"
                            label="E-mail"
                            :value="$data">

                        </x-input>                        

                    </div> 
                </div> 
            </x-tab-content>

            <x-tab-content id="avatar">                
                <div class="row">


                    <div class="col-md-6">
                        <x-input-img
                            labelTextfield="Avatar"
                            buttonTextfield="Imagem"
                            name="avatar"
                            :value="is_object($data)? $data->path_avatar : ''">
                        </x-input-img>
                    </div>


                </div>      
            </x-tab-content>

            <x-tab-content id="grupos">
                <div class="row">
                    <div class="col-md-6">
                        <x-input 
                            type="text"
                            id="grupo"
                            name="super_user"
                            icon="<i class = 'fas fa-envelope'></i>" 
                            placeholder="Super usuário"
                            label="Grupo"
                            :value="$data"
                        >
                        </x-input>
                    </div> 
                </div>      
            </x-tab-content>

            <x-tab-content id="status">
                <div class="row">
                    <div class="col-md-6">

                        <x-radio-button 
                            name="active"                             
                            labela="Ativo" 
                            labelb="Inativo" 
                            :value="$data">
                        </x-radio-button>

                    </div> 
                </div>      
            </x-tab-content>
            
            <x-tab-content id="password">                
                <div class="row">


                    <div class="col-md-6">
                        <x-input 
                            type="password"
                            id="password"
                            name="password"
                            icon="<i class = 'fas fa-key'></i>" 
                            label="Sua senha"
                            :value="$data"
                            >

                        </x-input>      
                    </div>


                </div>      
            </x-tab-content>


            <!-- close content tab -->
        </x-slot> 

    </x-tab>
    <!-- close tab -->

    <!-- Modal confirm and modal message -->
    <x-modal></x-modal>

</x-form>
<!-- close form -->

@endsection
