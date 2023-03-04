<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->string('ref');
            $table->string('type');
            $table->integer('time')->default(0);
            $table->float('salaire')->nullable();
            $table->timestamp('date_debut')->nullable();
            $table->timestamp('date_fin')->nullable();
            $table->foreignId('locality_id')->nullable()->constrained('localities');
            $table->foreignId('employer_id')->nullable()->constrained('employers');
            $table->foreignId('employee_id')->nullable()->constrained('employees');
            $table->foreignId('professional_category_id')->nullable()->constrained('professional_categories');
            $table->boolean('pending')->default(true);
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
        Schema::dropIfExists('contracts');
    }
}
