<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertificateofconformityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certificateofconformity', function (Blueprint $table) {
            $table->integer('id_certificateofconformity', true);
            $table->string('undersigned', 65)->nullable();
            $table->dateTime('date_a')->nullable();
            $table->string('place_a', 45)->nullable();
            $table->string('request_no_request_buildingpermit', 45)->nullable();
            $table->string('request_no_request', 45)->nullable()->index('fk_planningcertificate_request1_idx');
            $table->longText('notification_s')->nullable();
            $table->longText('sessionviewed_s')->nullable();
            $table->longText('folderfollow_s')->nullable();
            $table->longText('taxes_participations_s')->nullable();
            $table->double('cost_s')->nullable();
            $table->string('object_s')->nullable();
            $table->string('commune_s', 65)->nullable();
            $table->string('object_more_s')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('certificateofconformity');
    }
}
