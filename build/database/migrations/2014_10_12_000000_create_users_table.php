<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('ref');
            $table->string('firstname');
            $table->string('lastname');
            $table->enum('genre', ['male', 'female', 'none'])->default('none');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone')->nullable();
            $table->enum('role', ['super', 'admin', 'manager', 'observateur', 'general', 'directeur', 'secretaire', 'agent'])->default('agent');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('avatar')->nullable();
            $table->foreignId('entity_id')->nullable()->constrained('entities');
            $table->boolean('lock')->default(false);
            $table->timestamp('last_connection')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
