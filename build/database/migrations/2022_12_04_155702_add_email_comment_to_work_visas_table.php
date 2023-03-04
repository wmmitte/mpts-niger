<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEmailCommentToWorkVisasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('work_visas', function (Blueprint $table) {
            //
            $table->text('email_comment')->nullable();
            $table->string('numero')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('work_visas', function (Blueprint $table) {
            //
            $table->dropColumn('email_comment');
        });
    }
}
