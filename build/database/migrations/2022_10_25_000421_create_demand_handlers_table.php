<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDemandHandlersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demand_handlers', function (Blueprint $table) {
            $table->id();
            $table->string('ref');
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->foreignId('demand_id')->constrained('demands');
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
        Schema::dropIfExists('demand_handlers');
    }
}
