<?php

return [
    'user' => [
        'model' => \App\User::class,
    ],
    'from' => 'noreply@example.com',
    'expires' => false,
    'related' => [
        'active' => false,
        'model' => \App\ExampleModel::class,
        'resource_route' => '',
        'title' => 'Example',
        'id_column' => 'id',
        'value_column' => 'name',
        'user_foreign_key' => 'user_id',
        'owner_foreign_key' => null,
        'restrict_roles' => [
           'installer' 
        ]
	],
    'display' => [
        'card-header' => 'Invitations',
        'card-title' => '',
        'card-subtitle' => '',
        'search' => [
            'show' => true,
            'placeholder' => 'Search invitations',
            'button_text' => 'Search',
            'icon' => 'search',
            'route' => '/invitations/search'
        ],
        'create' => [
            'enabled' => true,
            'create_button' => [
                'text'  => 'Create Invitation',
                'route' => '/invitations/create'
            ],
        ]
    ],
	'resource_route' => '/invitations'
];
