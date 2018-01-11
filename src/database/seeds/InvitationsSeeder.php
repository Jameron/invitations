<?php

namespace Jameron\Import\database\seeds;

use Illuminate\Database\Seeder;

class InvitationsSeeder extends Seeder
{
    public function run()
    {
		$create_invitations_permission = factory(\Jameron\Regulator\Models\Permission::class, 'create_invitations')->create();
		$read_invitations_permission = factory(\Jameron\Regulator\Models\Permission::class, 'read_invitations')->create();
		$update_invitations_permission = factory(\Jameron\Regulator\Models\Permission::class, 'update_invitations')->create();
		$delete_invitations_permission = factory(\Jameron\Regulator\Models\Permission::class, 'delete_invitations')->create();
	    $admin_role = \Jameron\Regulator\Models\Role::where ('slug', 'admin')->first();
        $admin_role->givePermissionTo($create_invitations_permission);
        $admin_role->givePermissionTo($read_invitations_permission);
        $admin_role->givePermissionTo($update_invitations_permission);
        $admin_role->givePermissionTo($delete_invitations_permission);
	}
}
