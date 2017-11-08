<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvitationsRoleUserTable extends Migration
{

    public function up()
    {
        Schema::create('invitations_role_user', function (Blueprint $table) {
			$table->integer('role_id')->unsigned();
			$table->foreign('role_id')->references('id')->on('regulator_roles')->onDelete('cascade');
			$table->integer('invitation_id')->unsigned();
			$table->foreign('invitation_id')->references('id')->on('invitations')->onDelete('cascade');
            $table->timestamps();

			$table->primary(['role_id', 'invitation_id']);
        });
    }

    public function down()
    {
        Schema::drop('invitations_role_user');
    }
}
