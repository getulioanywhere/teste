<?php

return [
    'name' => 'Company',//NOME DO MODULE
    'namelower' => 'company',//NOME DO MODULE
    
    /* select personalisado para montagem de tabelas e outros */
    'select-table' =>
    [
        'id as ID', 
        'cnpj as CNPJ',
        'name as Nome',        
    ],
    
    /* Names routes e routes url */
    'routes' =>
    [
        'table' => [
            'url' => '/company-list',
            'name' => 'company.list'
        ],
        'show' => [
            'url' => '/company-show/',
            'name' => 'company.show'
        ],
        'update'=>[
            'url' => '/company-update/',
            'name' => 'company.update'
        ],  
        'destroy'=>[
            'url' => '/company-destroy/',
            'name' => 'company.destroy'
        ],  
        'new'=>[
            'url' => '/company-new/',
            'name' => 'company.new'
        ],  
        'create'=>[
            'url' => '/company-create/',
            'name' => 'company.create'
        ],  
        
    ],
    /* Traduções de acordo com o lang em resources */
    'lang' => [
        'table-list' => 'table-list',
        'show-update' => 'show-update',
        'show-creat' => 'show-creat',
        'data-maintenance' => 'data-maintenance',
        'data-creater'=>'data-creater',
        'data-companyid'=>'data-companyid'
    ],
    'validation' => [
        'name' => 'required',
            'foundation' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'facebook' => 'nullable',
            'instagram' => 'nullable',
            'whatsapp_1' => 'required',
            'whatsapp_2' => 'nullable',
            'twitter' => 'nullable',
            'youtube' => 'nullable',
            'linkedin' => 'nullable',
            'address_street' => 'required',
            'address_number' => 'nullable',
            'address_neighborhood' => 'required',
            'address_city' => 'required',
            'address_state' => 'required',
            'address_zipcod' => 'nullable',
            'opening_hours' => 'nullable',
            'map' => 'nullable',
    ]
];
