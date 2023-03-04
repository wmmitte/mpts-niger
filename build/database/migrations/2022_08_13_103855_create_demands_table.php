<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDemandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demands', function (Blueprint $table) {
            $table->id();
            $table->string('ref');
            $table->enum('type', ['nouvelle', 'renouvellement']);
            $table->string('secteur')->nullable();
            $table->string('applicant_fullname');
            $table->string('applicant_phone');
            $table->string('applicant_email')->unique()->nullable();
            $table->text('reason')->nullable();
            $table->foreignId('activity_sector_id')->nullable()->constrained('activities');
            $table->foreignId('industry_id')->nullable()->constrained('activities');
            $table->foreignId('contract_id')->nullable()->constrained('contracts');
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->integer('step')->default(1);
            $table->integer('state')->default(-1);
            $table->timestamps();
        });
    }

    /**
     * step
     * 1=contract position
     * 2=emplyee
     * 3=employer
     * 4=piece
     * 5=attach
     * 6=end
     * 0=finale registration
     */

    /**
     * State :
     * -2 = rejeter
     * -1 = brouillon
     *  0 = enregistrement definitif
     *  1 = accepter
     *  2 = courier
     *  3 = contrat
     *  4 = operation
     *  5 = DG
     *  6 = DAEP
     *  7 = SG
     *  8 = Ministre
     */

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('demands');
    }
}
