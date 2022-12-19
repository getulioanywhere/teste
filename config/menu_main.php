<?php

return [
    [
        'title' => 'Templates',
        'icon' => '<i class="nav-icon fas fa-circle"></i>',
        'children' =>
        [
            [
                'icon' => '<i class="far fa-circle nav-icon"></i>',
                'title' => 'Cabeçalho',
                'url' => '#',
                'children' => [
                    [
                        'icon' => '<i class="far fa-circle nav-icon"></i>',
                        'title' => 'Barra',
                        'url' => '#'
                    ],
                    [
                        'icon' => '<i class="far fa-circle nav-icon"></i>',
                        'title' => 'Menu',
                        'url' => '/menu'
                    ]
                ]
            ],
            [
                'icon' => '<i class="far fa-circle nav-icon"></i>',
                'title' => 'Contato',
                'url' => '#'
            ],
            [
                'icon' => '<i class="far fa-circle nav-icon"></i>',
                'title' => 'Rodapé',
                'url' => '#'
            ]
        ]
    ]
];

