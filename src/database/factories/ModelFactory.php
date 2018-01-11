<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/
$factory->defineAs(Jameron\Regulator\Models\Permission::class, 'create_invitations', function (Faker\Generator $faker) {
    return [
        'slug' => 'create_invitations',
        'name' => 'Create Invitations',
    ];
});
$factory->defineAs(Jameron\Regulator\Models\Permission::class, 'read_invitations', function (Faker\Generator $faker) {
    return [
        'slug' => 'read_invitations',
        'name' => 'Read Invitations',
    ];
});
$factory->defineAs(Jameron\Regulator\Models\Permission::class, 'update_invitations', function (Faker\Generator $faker) {
    return [
        'slug' => 'update_invitations',
        'name' => 'Update Invitations',
    ];
});
$factory->defineAs(Jameron\Regulator\Models\Permission::class, 'delete_invitations', function (Faker\Generator $faker) {
    return [
        'slug' => 'delete_invitations',
        'name' => 'Delete Invitations',
    ];
});
