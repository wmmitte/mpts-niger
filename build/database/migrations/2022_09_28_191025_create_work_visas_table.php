<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkVisasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_visas', function (Blueprint $table) {
            $table->id();
            $table->string('ref');
            $table->string('numero');
            $table->foreignId('demand_id')->nullable()->constrained('demands');
            $table->integer('duration');
            $table->timestamp('start_date');
            $table->timestamp('end_date');
            $table->text('observation')->nullable();
            $table->timestamp('withdraw_at')->nullable();
            $table->string('file_url')->nullable();
            $table->integer('state')->default(0);
            $table->timestamps();
        });
    }
    /**
     * -3 => visa brouillon
     * -2 => visa brouillon
     * -1 => visa expirer
     * 0 => visa accorder
     * 1 => visa remis
     */

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('work_visas');
    }
}
