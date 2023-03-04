<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDemandFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demand_files', function (Blueprint $table) {
            $table->id();
            $table->string('ref');
            $table->string('wording');
            $table->string('type')->nullable();
            $table->string('url_file')->nullable();
            $table->foreignId('demand_id')->nullable()->constrained('demands');
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
        Schema::dropIfExists('demand_files');
    }
}
