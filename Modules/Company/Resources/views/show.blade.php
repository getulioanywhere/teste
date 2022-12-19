@extends('masterpage.master')

@section('content')
{{--@dd($data)--}}
<!-- open form -->
<x-form action="{{ $route }}" method="POST" enctype="true">
    <?php
    $array = [];
    array_push($array, ['modal' => 'confirm-save', 'text' => 'Salvar']);
    array_push($array, ['onclick' => 'history.back();', 'text' => 'Voltar', 'bgcolor' => 'bg-gradient-secondary']);
    $create = isset($routeCreate) ? ['locationhref' => $routeCreate, 'text' => 'Cadastrar Novo', 'bgcolor' => 'bg-gradient-primary'] : null;
    if (!is_null($create)) {
        array_push($array, $create);
    }
    ?>

    <!-- button opne modal -->
    <x-button :array="$array"></x-button>

    <!-- open tab -->
    <x-tab :titlestr="$title" :namestr="$namestr">
        <x-slot name="nav">
            <!-- headers tab menu nav -->
            <x-tab-list-nav id="dados" title="Dados" active="active" selected="true"></x-tab-list-nav>

            <x-tab-list-nav id="contato" title="Contatos"></x-tab-list-nav>

            <x-tab-list-nav id="endereco" title="Endereço"></x-tab-list-nav>

            <x-tab-list-nav id="map" title="Google Map"></x-tab-list-nav>

            <x-tab-list-nav id="social" title="Social"></x-tab-list-nav>

            <x-tab-list-nav id="midia" title="Mídias"></x-tab-list-nav>
        </x-slot>

        <x-slot name="content">
            <!-- open content tab -->
            <x-tab-content id="dados" active="active">

                <div class="row">
                    <div class="col-md-4">
                        <x-input 
                            type="text" 
                            id="name"
                            name="name"
                            placeholder="Nome da empresa"
                            label="Nome da empresa"
                            :value="$data">
                        </x-input>
                    </div>
                    <div class="col-md-4">
                        <x-input 
                            type="text"                            
                            id="http_website"
                            name="http_website"
                            placeholder="URL de conexão com API do Website para caches"
                            label="URL para API Website"
                            :value="$data">
                        </x-input>
                    </div>
                </div>

                <div class="row">


                    <div class="col-md-2">
                        <x-input 
                            type="date" 
                            id="foundation"
                            name="foundation"
                            label="Data de Fundação"
                            :value="$data">
                        </x-input>
                    </div>
                </div>

            </x-tab-content>

            <x-tab-content id="contato">
                <div class="row">
                    <div class="col-md-3">
                        <x-input 
                            type="email" 
                            id="email"
                            name="email"
                            faicon="fas fa-envelope" 
                            placeholder="exemplo@email.com"
                            label="E-mail"
                            :value="$data">
                        </x-input>    
                    </div>
                    <div class="col-md-3">
                        <x-input 
                            type="text" 
                            id="phone"
                            name="phone"
                            faicon="fas fa-envelope" 
                            placeholder="Telefone"
                            label="Telefone"
                            :value="$data">
                        </x-input>     
                    </div>
                    <div class="col-md-3">
                        <x-input 
                            type="text" 
                            id="whatsapp_1"
                            name="whatsapp_1"
                            faicon="fa fa-envelope" 
                            placeholder="Whatsapp 1"
                            label="Whatsapp"
                            :value="$data">
                        </x-input>       
                    </div>
                    <div class="col-md-3">
                        <x-input 
                            type="text" 
                            id="whatsapp_2"
                            name="whatsapp_2"
                            faicon="fa fa-envelope" 
                            placeholder="Whatsapp 2"
                            label="Whatsapp"
                            :value="$data">
                        </x-input>  
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <x-text-area
                            
                            name="opening_hours"
                            label="Atendimento"                           
                            :value="$data">
                                
                        </x-text-area>
                    </div>
                </div> 
            </x-tab-content>

            <x-tab-content id="endereco">

                <div class="row">
                    <div class="col-md-6">

                        <x-input 
                            type="text" 
                            id="address_street"
                            name="address_street"
                            faicon="fas fa-envelope" 
                            placeholder="Rua"
                            label="Rua"
                            :value="$data">
                        </x-input>      

                        <x-input 
                            type="text" 
                            id="address_number"
                            name="address_number"
                            faicon="fas fa-envelope" 
                            placeholder="Numero"
                            label="Numero"
                            :value="$data">
                        </x-input>

                        <x-input 
                            type="text" 
                            id="address_neighborhood"
                            name="address_neighborhood"
                            faicon="fas fa-envelope" 
                            placeholder="Bairro"
                            label="Bairro"
                            :value="$data">
                        </x-input>

                        <x-input 
                            type="text" 
                            id="address_city"
                            name="address_city"
                            faicon="fas fa-envelope" 
                            placeholder="Cidade"
                            label="Cidade"
                            :value="$data">
                        </x-input>       

                        <x-input 
                            type="text" 
                            id="address_state"
                            name="address_state"
                            faicon="fas fa-envelope" 
                            placeholder="Estado"
                            label="Estado"
                            :value="$data">
                        </x-input>       

                        <x-input 
                            type="text" 
                            id="address_zipcod"
                            name="address_zipcod"
                            faicon="fas fa-envelope" 
                            placeholder="Cep"
                            label="Cep"
                            :value="$data">
                        </x-input>       



                    </div> 
                </div>

            </x-tab-content>

            <x-tab-content id="map">
                <x-text-area
                    class="form-control"
                    rows="5"
                    name="map"
                    label="Google Maps"                    
                    :value="$data">
                </x-text-area>
            </x-tab-content>

            <x-tab-content id="social">

                <div class="row">
                    <div class="col-md-6">

                        <x-input 
                            type="text" 
                            id="facebook"
                            name="facebook"
                            faicon="fas fa-envelope" 
                            placeholder="Facebook"
                            label="Facebook"
                            :value="$data">
                        </x-input>       

                        <x-input 
                            type="text" 
                            id="instagram"
                            name="instagram"
                            faicon="fas fa-envelope" 
                            placeholder="Instagram"
                            label="Instagram"
                            :value="$data">
                        </x-input>

                        <x-input 
                            type="text" 
                            id="twitter"
                            name="twitter"
                            faicon="fas fa-envelope" 
                            placeholder="Twitter"
                            label="Twitter"
                            :value="$data">
                        </x-input>

                        <x-input 
                            type="text" 
                            id="linkedin"
                            name="linkedin"
                            faicon="fas fa-envelope" 
                            placeholder="Linkedin"
                            label="Linkedin"
                            :value="$data">
                        </x-input>       

                        <x-input 
                            type="text" 
                            id="youtube"
                            name="youtube"
                            faicon="fas fa-envelope" 
                            placeholder="Youtube"
                            label="Youtube"
                            :value="$data">
                        </x-input>       


                    </div> 
                </div>


            </x-tab-content>

            <x-tab-content id="midia">
                <div class="container-fluid py-3 px-0">
                
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 d-flex flex-column align-items-center">
                                            <x-input-img
                                                labelTextfield="Cabeçalho"
                                                buttonTextfield="Enviar"
                                                name="header"
                                                :value="is_object($data)? $data->path_header : ''">
                                            </x-input-img>
                                        </div>
                                        <div class="col-md-6 d-flex flex-column align-items-center">
                                            <x-input-img
                                                labelTextfield="Rodapé"
                                                buttonTextfield="Enviar"
                                                name="footer"
                                                :value="is_object($data)? $data->path_footer : ''">
                                            </x-input-img>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4 d-flex flex-column align-items-center">
                                            <x-input-img
                                                labelTextfield="Selo 1"
                                                buttonTextfield="Enviar"
                                                name="seal_1"
                                                :value="is_object($data)? $data->path_seal_1 : ''">
                                            </x-input-img>
                                        </div>
                                        <div class="col-md-4 d-flex flex-column align-items-center">
                                            <x-input-img
                                                labelTextfield="Selo 2"
                                                buttonTextfield="Enviar"
                                                name="seal_2"
                                                :value="is_object($data)? $data->path_seal_2 : ''">
                                            </x-input-img>                                        
                                        </div>
                                        <div class="col-md-4 d-flex flex-column align-items-center">
                                            <x-input-img
                                                labelTextfield="Favicon"
                                                buttonTextfield="Enviar"
                                                name="seal_3"
                                                :value="is_object($data)? $data->path_seal_3 : ''">
                                            </x-input-img>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
