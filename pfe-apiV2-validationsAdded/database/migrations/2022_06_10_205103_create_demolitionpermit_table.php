<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDemolitionpermitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demolitionpermit', function (Blueprint $table) {
            $table->integer('id_demolitionpermit', true);
            $table->string('last_name', 45)->nullable();
            $table->string('fist_name', 45)->nullable();
            $table->string('address', 20)->nullable();
            $table->string('postal_code', 20)->nullable();
            $table->string('email', 30)->nullable();
            $table->string('phone_number', 30)->nullable();
            $table->string('owner_name', 45)->nullable();
            $table->tinyInteger('is_owner')->nullable();
            $table->tinyInteger('is_representative')->nullable();
            $table->string('more_information', 45)->nullable();
            $table->string('social_reason', 45)->nullable();
            $table->dateTime('date_a')->nullable();
            $table->string('place_a', 45)->nullable();
            $table->string('arrondissement_g', 45)->nullable();
            $table->string('district_g', 45)->nullable();
            $table->string('placesaid_g', 45)->nullable();
            $table->string('street_g', 45)->nullable();
            $table->string('id_landtitle_g', 45)->nullable();
            $table->double('area_g')->nullable();
            $table->double('surfaceoutfloors_g')->nullable();
            $table->double('surfaceoutdemolition_g')->nullable();
            $table->string('totalbuilding_g', 100)->nullable();
            $table->tinyInteger('is_diilapided_g')->nullable();
            $table->tinyInteger('is_abandoned_g')->nullable();
            $table->tinyInteger('is_living_g')->nullable();
            $table->string('more_information_g', 200)->nullable();
            $table->tinyInteger('is_newbuilding_g')->nullable();
            $table->tinyInteger('is_relhousing_g')->nullable();
            $table->tinyInteger('is_ruined_g')->nullable();
            $table->tinyInteger('is_abandonedg_g')->nullable();
            $table->string('more_informationg_g', 200)->nullable();
            $table->string('forstability_g')->nullable();
            $table->string('forneighborhood_g')->nullable();
            $table->tinyInteger('is_justificatif_r')->nullable();
            $table->tinyInteger('is_situationplan_r')->nullable();
            $table->tinyInteger('is_groundplan_r')->nullable();
            $table->tinyInteger('is_executionplan_r')->nullable();
            $table->string('request_no_request', 45)->nullable()->index('fk_planningcertificate_request1_idx');
            $table->longText('notification_s')->nullable();
            $table->longText('sessionviewed_s')->nullable();
            $table->longText('folderfollow_s')->nullable();
            $table->longText('taxes_participations_s')->nullable();
            $table->string('last_name_o', 45)->nullable();
            $table->string('fist_name_o', 45)->nullable();
            $table->string('address_o', 20)->nullable();
            $table->string('postal_code_o', 20)->nullable();
            $table->string('email_o', 30)->nullable();
            $table->string('phone_number_o', 30)->nullable();
            $table->double('cost_s')->nullable();
            $table->string('object_s')->nullable();
            $table->longText('location_s')->nullable();
            $table->string('level_g')->nullable();
            $table->string('height_g')->nullable();
            $table->string('object_more_s')->nullable();
            $table->string('surfaceoutfloors_unit_g', 15)->nullable();
            $table->string('surfaceoutdemolition_unit_g', 15)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('demolitionpermit');
    }
}
