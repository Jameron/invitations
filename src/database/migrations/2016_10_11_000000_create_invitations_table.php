<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvitationsTable extends Migration
{
    public function up()
    {
        Schema::create('invitations', function (Blueprint $table) {

            $table->increments('id');
            $table->string('message_id')->nullable();
            $table->enum('status', ['pending','delivery','bounce','complaint'])
                ->default('pending');
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->string('token')->unique();
            $table->timestamp('sent_at')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->integer('invitable_id')->unsigned(); // Id of the related model like product_id, or other thing_id
            $table->string('invitable_type'); // Class name of the owning model so Products, or Things
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('invitations');
    }
}
