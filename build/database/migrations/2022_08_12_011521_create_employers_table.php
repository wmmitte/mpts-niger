<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employers', function (Blueprint $table) {
            $table->id();
            $table->string('ref');
            $table->string('raison_social');
            $table->json('phone');
            $table->string('email');
            $table->string('web_site')->nullable();
            $table->string('mailbox')->nullable();
            $table->enum('etat', ['actif', 'inactif'])->default('actif');
            $table->string('quarter')->nullable();
            $table->boolean('is_verifed')->default(true);
            $table->string('logo')->nullable();
            $table->foreignId('locality_id')->nullable()->constrained('localities');
            // $table->foreignId('activity_id')->nullable()->constrained('activities');
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->boolean('state')->default(true);
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
        Schema::dropIfExists('employers');
    }
}
