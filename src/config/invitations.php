<?php

return [
    'user_model' => \App\User::class,
    'from' => 'noreply@example.com',
    'expires_at' => null, // number of days
    'related' => [
        'active' => false,
        'model' => \App\ExampleModel::class,
        'title' => 'Example'
        'id_column' => 'id',
        'value_column' => 'name'
    ]
];
