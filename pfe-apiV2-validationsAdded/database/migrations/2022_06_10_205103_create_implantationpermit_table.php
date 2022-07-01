<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImplantationpermitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('implantationpermit', function (Blueprint $table) {
            $table->integer('id_implantationpermit', true);
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
            $table->tinyInteger('is_operationalsector_g')->nullable();
            $table->tinyInteger('is_restructuringarea_g')->nullable();
            $table->tinyInteger('is_renovationarea_g')->nullable();
            $table->tinyInteger('is_subdivide_stateowned_g')->nullable();
            $table->tinyInteger('is_subdivide_communal_g')->nullable();
            $table->tinyInteger('is_subdivide_private_g')->nullable();
            $table->tinyInteger('is_jointdevelopmentzone_g')->nullable();
            $table->string('more_infromation_g', 45)->nullable();
            $table->tinyInteger('is_servitudey_g')->nullable();
            $table->tinyInteger('is_justificatif_r')->nullable();
            $table->tinyInteger('is_attestation_r')->nullable();
            $table->tinyInteger('is_planningcertificate_r')->nullable();
            $table->tinyInteger('is_descriptivequote_r')->nullable();
            $table->tinyInteger('is_situation_plan_r')->nullable();
            $table->tinyInteger('is_buildingplan_r')->nullable();
            $table->tinyInteger('is_new_building_p')->nullable();
            $table->tinyInteger('is_developement_work_p')->nullable();
            $table->tinyInteger('is_living_operation_p')->nullable();
            $table->string('more_information_p', 45)->nullable();
            $table->tinyInteger('is_industrial_p')->nullable();
            $table->tinyInteger('is_agricultural_p')->nullable();
            $table->tinyInteger('is_public_p')->nullable();
            $table->tinyInteger('is_living_use_p')->nullable();
            $table->tinyInteger('is_commercial_p')->nullable();
            $table->tinyInteger('is_office_p')->nullable();
            $table->string('more_informationg_p', 45)->nullable();
            $table->double('area_out_use_p')->nullable();
            $table->tinyInteger('construction_company_p')->nullable();
            $table->tinyInteger('is_personal_funding_f')->nullable();
            $table->tinyInteger('is_loan_financing_f')->nullable();
            $table->string('lender_f', 45)->nullable();
            $table->string('more_information_f', 45)->nullable();
            $table->string('last_name_f', 45)->nullable();
            $table->string('fist_name_f', 45)->nullable();
            $table->string('postal_code_f', 20)->nullable();
            $table->string('email_f', 30)->nullable();
            $table->string('phone_number_f', 30)->nullable();
            $table->string('onac_id_f', 45)->nullable();
            $table->string('onuc_id_f', 45)->nullable();
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
        Schema::dropIfExists('implantationpermit');
    }
}
