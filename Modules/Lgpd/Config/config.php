<?php

return [
    'name' => 'Lgpd', //NOME DO MODULE
    'namelower' => 'lgpd', //NOME DO MODULE
    /* select personalisado para montagem de tabelas e outros */
    'select-table' =>
    [
        'ip as IP',
        'type as Tipo',
        'data as Data'
    ],    
    /* Names routes e routes url */
    'routes' =>
    [
        'table' => [
            'url' => 'lgpd-list',
            'name' => 'lgpd.list'
        ],
        
        'show' => [
            'url' => '/lgpd-show/',
            'name' => 'lgpd.show'
        ],
        'update' => [
            'url' => '/lgpd-update/',
            'name' => 'lgpd.update'
        ],
        'destroy' => [
            'url' => '/lgpd-destroy/',
            'name' => 'lgpd.destroy'
        ],
        'new' => [
            'url' => '/lgpd-new/',
            'name' => 'lgpd.new'
        ],
        'create' => [
            'url' => '/lgpd-create/',
            'name' => 'lgpd.create'
        ],
    ],
    /* Traduções de acordo com o lang em resources */
    'lang' => [
        'table-list' => 'table-list',
        'show-update' => 'show-update',
        'show-creat' => 'show-creat',
        'data-maintenance' => 'data-maintenance',
        'data-creater' => 'data-creater',
        'data-lgpdid' => 'data-lgpdid'
    ],
        /* //Names routes e routes url 
          'routes' =>
          [
          'table' => [
          'url' => '/lgpd-list',
          'name' => 'lgpd.list'
          ],
          'show' => [
          'url' => '/lgpd-show/',
          'name' => 'lgpd.show'
          ],
          'update'=>[
          'url' => '/lgpd-update/',
          'name' => 'lgpd.update'
          ],
          'destroy'=>[
          'url' => '/lgpd-destroy/',
          'name' => 'lgpd.destroy'
          ],
          'new'=>[
          'url' => '/lgpd-new/',
          'name' => 'lgpd.new'
          ],
          'create'=>[
          'url' => '/lgpd-create/',
          'name' => 'lgpd.create'
          ],

          'modal' => [
          'show'=>[
          'url' => '/modal-show/',
          'name' => 'modal.show'
          ],
          'create' => [
          'url' => '/modal-create/',
          'name' => 'modal.create'
          ]
          ]
          ],
          // Traduções de acordo com o lang em resources
          'lang' => [
          'table-list' => 'table-list',
          'show-update' => 'show-update',
          'show-creat' => 'show-creat',
          'data-maintenance' => 'data-maintenance',
          'data-creater'=>'data-creater',
          'data-lgpdid'=>'data-lgpdid',
          ], */
];
