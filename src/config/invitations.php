<?php

$invitations = [
    'user' => [
        'model' => \App\Models\User::class,
    ],
    'from' => 'noreply@example.com',
    'expires' => false,
    'related' => [
        'active' => true,
        'model' => \App\Models\Example::class,
        'resource_route' => '/examples',
        'title' => 'example',
        'id_column' => 'id',
        'value_column' => 'name',
        'user_foreign_key' => 'user_id', 
        'owner_foreign_key' => 'example_creator_user_id',
        'restrict_roles' => [
            'user' 
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
    ],
    'create' => [
        'enabled' => true,
        'button' => [
            'text'  => 'Create Invitation',
            'route' => '/invitations/create'
        ],
    ],
    'index' => [
        'card-header' => 'Invitations',
        'card-title' => '',
        'card-subtitle' => '',
        'search' => [
            'show' => true,
            'placeholder' => 'Search invitations',
            'button_text' => 'Search',
            'icon' => 'search',
            'route' => '/invitations/search',
        ],
        'online_status_identifier' => '<span class="online"></span>',
        'offline_status_identifier' => '<span class="offline"></span>',
    ],
    'resource_route' => '/invitations',
    'invitable_roles' => [
        [
            'role' => 'admin',
            'can_invite_new' => [
                'admin', 
            ],
        ]
    ],
    'permissions' => [
        'create'=>[
            'slug' => 'create_invitations',
            'roles' => ['admin'],
        ],
        'read'=>[
            'slug'=>'read_invitations',
            'roles' => ['admin']
        ],
        'update'=>[
            'slug'=>'update_permissions',
            'roles' => ['admin']
        ],
        'delete'=>[
            'slug'=>'delete_permissions',
            'roles' => ['admin']
        ]
    ],
];

$invitations['roles'] =
    [
        'admin' => [
            [
                'column' => 'id',
                'label' => 'ID',
            ],
            [
                'column' => 'first_name',
                'label' => 'First Name'
            ],
            [
                'column' => 'last_name',
                'label' => 'Last name'
            ],
            [
                'column' => 'email',
                'label' => 'Email',
            ],
            [
                'column' => 'related', 
                'label' => 'Related Model',
                'link'=>[
                    'id_column' => $invitations['related']['id_column'],
                    'resource_route'=>$invitations['related']['resource_route']
                ]
            ],
            [
                'column' => 'sent_at',
                'label' => 'Sent At'
            ],
            [
                'column' => 'status',
                'label' => 'Status'
            ]
        ]
    ];

return $invitations;
