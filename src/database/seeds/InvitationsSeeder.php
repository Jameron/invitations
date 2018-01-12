<?php

namespace Jameron\Import\database\seeds;

use Illuminate\Database\Seeder;

class InvitationsSeeder extends Seeder
{
    public function run()
    {

        $permissions = config('invitations.permissions');

        foreach($permissions as $permission => $permission_settings) {

            $permission = factory(\Jameron\Regulator\Models\Permission::class, $permission_settings['slug'] )->create();

            foreach($permission_settings['roles'] as $role) {
                $role = \Jameron\Regulator\Models\Role::where ('slug', $role)->first();
                $role->givePermissionTo($permission);
            }
        }
	}
}
