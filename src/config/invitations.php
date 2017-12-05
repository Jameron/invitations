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
        'owner_foreign_key' => null
	],
	'route' => '/invitations'
];
