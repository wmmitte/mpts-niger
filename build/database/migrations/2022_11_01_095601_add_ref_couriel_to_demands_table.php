<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRefCourielToDemandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('demands', function (Blueprint $table) {
            //
            $table->string('ref_couriel')->nullable();
            $table->string('numero_couriel')->nullable();
            $table->string('objet_couriel')->nullable();
            $table->text('paragraphe_one_couriel')->nullable();
            $table->text('paragraphe_two_couriel')->nullable();
            $table->text('paragraphe_three_couriel')->nullable();
            $table->text('paragraphe_four_couriel')->nullable();
            $table->text('paragraphe_five_couriel')->nullable();
            $table->text('am_one_couriel')->nullable();
            $table->text('am_two_couriel')->nullable();
            $table->text('am_three_couriel')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('demands', function (Blueprint $table) {
            //
            $table->dropColumn('ref_couriel');
            $table->dropColumn('numero_couriel');
            $table->dropColumn('objet_couriel');
            $table->dropColumn('paragraphe_one_couriel');
            $table->dropColumn('paragraphe_two_couriel');
            $table->dropColumn('paragraphe_three_couriel');
            $table->dropColumn('paragraphe_four_couriel');
            $table->dropColumn('paragraphe_five_couriel');
            $table->dropColumn('am_one_couriel');
            $table->dropColumn('am_two_couriel');
            $table->dropColumn('am_three_couriel');
        });
    }
}
