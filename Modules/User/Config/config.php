<?php

return [
    'name' => 'User',//NOME DO MODULE
    'namelower' => 'user',//NOME DO MODULE
    
    /* select personalisado para montagem de tabelas e outros */
    'select-table' =>
    [
        'id as ID',
        'path_avatar as Avatar',
        'name as Nome',
        'email as E-Mail',
        'active as Status',
        'created_at as Criado',
        'updated_at as Atualizado'
    ],
    
    /* Names routes e routes url */
    'routes' =>
    [
        'table' => [
            'url' => '/user-list',
            'name' => 'user.list'
        ],
        'show' => [
            'url' => '/user-show/',
            'name' => 'user.show'
        ],
        'update'=>[
            'url' => '/user-update/',
            'name' => 'user.update'
        ],  
        'destroy'=>[
            'url' => '/user-destroy/',
            'name' => 'user.destroy'
        ],  
        'new'=>[
            'url' => '/user-new/',
            'name' => 'user.new'
        ],  
        'create'=>[
            'url' => '/user-create/',
            'name' => 'user.create'
        ],  
        
    ],
    
    /* Traduções de acordo com o lang em resources */
    'lang' => [
        'table-list' => 'table-list',
        'show-update' => 'show-update',
        'show-creat' => 'show-creat',
        'data-maintenance' => 'data-maintenance',
        'data-creater'=>'data-creater',
        'data-userid'=>'data-userid'
    ]
];
