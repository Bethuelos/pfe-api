<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanningcertificateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planningcertificate', function (Blueprint $table) {
            $table->integer('id_planiningcertificate', true);
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
            $table->tinyInteger('is_situation_plan_r')->nullable();
            $table->tinyInteger('is_owner_procuration_r')->nullable();
            $table->tinyInteger('is_living_house_building_p')->nullable();
            $table->tinyInteger('is_commercial_work_p')->nullable();
            $table->tinyInteger('is_industrial_work_p')->nullable();
            $table->tinyInteger('is_siubdivision_p')->nullable();
            $table->string('more_information_p', 45)->nullable();
            $table->string('request_no_request', 45)->nullable()->index('fk_planningcertificate_request1_idx');
            $table->longText('notification_s')->nullable();
            $table->longText('sessionviewed_s')->nullable();
            $table->longText('folderfollow_s')->nullable();
            $table->longText('taxes_participations_s')->nullable();
            $table->tinyInteger('is_PDU_s')->nullable();
            $table->tinyInteger('is_POS_s')->nullable();
            $table->tinyInteger('is_PS_s')->nullable();
            $table->tinyInteger('is_PSU_s')->nullable();
            $table->tinyInteger('is_RGU_s')->nullable();
            $table->string('landlocated_s', 45)->nullable();
            $table->tinyInteger('is_non_aedificandi_s')->nullable();
            $table->tinyInteger('is_buildable_s')->nullable();
            $table->tinyInteger('is_transferable_s')->nullable();
            $table->tinyInteger('is_non_transferable_s')->nullable();
            $table->string('more_information_g_s', 45)->nullable();
            $table->longText('accessibility_ways_s')->nullable();
            $table->longText('accessibiility_servitudes_s')->nullable();
            $table->string('specifications_partof_s')->nullable();
            $table->string('specifications_operations_s')->nullable();
            $table->tinyInteger('is_riskarea_s')->nullable();
            $table->tinyInteger('is_DPUground_s')->nullable();
            $table->tinyInteger('is_RAS_s')->nullable();
            $table->string('more_information_s', 45)->nullable();
            $table->string('last_name_o', 45)->nullable();
            $table->string('fist_name_o', 45)->nullable();
            $table->string('address_o', 20)->nullable();
            $table->string('postal_code_o', 20)->nullable();
            $table->string('email_o', 30)->nullable();
            $table->string('phone_number_o', 30)->nullable();
            $table->double('cost_s')->nullable();
            $table->string('object_s')->nullable();
            $table->longText('location_s')->nullable();
            $table->string('object_more_s')->nullable();
            $table->string('area_unit_g', 15)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('planningcertificate');
    }
}
