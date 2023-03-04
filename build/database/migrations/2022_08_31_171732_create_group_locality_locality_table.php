<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupLocalityLocalityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_locality_locality', function (Blueprint $table) {
            $table->id();
            $table->foreignId('group_locality_id')->unsigned()->constrained('group_localities');
            $table->foreignId('locality_id')->unsigned()->constrained('localities');
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
        Schema::dropIfExists('group_locality_locality');
    }
}
