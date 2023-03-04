<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocalitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('localities', function (Blueprint $table) {
            $table->id();
            $table->string('ref');
            $table->string('wording');
            $table->enum('type', ['continent', 'country', 'district', 'city', 'locality'])->default('locality');
            $table->string('nationality')->nullable();
            $table->string('flat')->nullable();
            $table->foreignId('locality_id')->nullable()->constrained('localities');
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
        Schema::dropIfExists('localities');
    }
}
