<?php

$module = 'Modules/';
$website = 'Website/';
$catalog = 'Catalog/';
$sgd= 'sgd/';
return [
    'modules' => [
        'Company',
        'Lgpd',
        'Smtp',
        'Email',
        'MenuSystem',
        //'Header',
        'Menu',
       // 'Home',
        //'About',
        //'Contact',
        'Pages',
        //'Footer',
        'Catalog',
        'Categories',
        'Documents',
        'Clients',
    ],
    'path' => [
        $module . 'Company',
        $module . 'Lgpd',
        $module . 'Smtp',
        $module . 'Email',
        $module . 'MenuSystem',
        //$website . 'Header',
        $website . 'Menu',
        //$website . 'Home',
        //$website . 'About',
        //$website . 'Contact',
        $website . 'Pages',
        //$website . 'Footer',
        $catalog . 'Categories',
        $catalog . 'Catalog',
        $sgd . 'Documents',
        $sgd . 'Clients',
    ]
];

