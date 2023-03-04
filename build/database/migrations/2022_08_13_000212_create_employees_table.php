<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('ref');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email')->unique()->nullable();
            $table->timestamp('date_of_birth')->nullable();
            $table->string('residence')->nullable();
            $table->string('nationalite')->nullable();
            $table->enum('genre', ['male', 'female', 'none'])->default('none');
            $table->string('marital_status')->nullable();
            $table->string('profession')->nullable();
            $table->string('mailbox')->nullable();
            $table->string('quartier')->nullable();
            $table->string('phone')->nullable();
            $table->foreignId('locality_id')->nullable()->constrained('localities');
            $table->foreignId('activity_id')->nullable()->constrained('activities');
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
        Schema::dropIfExists('employees');
    }
}
