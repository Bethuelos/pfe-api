<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAutorizationtontosubdivideTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('autorizationtontosubdivide', function (Blueprint $table) {
            $table->integer('id_autorizationtontosubdivide', true);
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
            $table->double('area_tosubdivide_g')->nullable();
            $table->string('north_g', 45)->nullable();
            $table->string('south_g', 45)->nullable();
            $table->string('east_g', 45)->nullable();
            $table->string('west_g', 45)->nullable();
            $table->tinyInteger('is_servitudey_g')->nullable();
            $table->integer('numberoflots_l')->nullable();
            $table->string('planned_eqipment_l', 205)->nullable();
            $table->tinyInteger('is_blocksboundary_l')->nullable();
            $table->tinyInteger('is_lotsboundary_l')->nullable();
            $table->tinyInteger('is_trackopening_l')->nullable();
            $table->tinyInteger('is_crossing_canalbuilding_l')->nullable();
            $table->tinyInteger('is_variouscanal_building_l')->nullable();
            $table->tinyInteger('is_owner_procuration_r')->nullable();
            $table->tinyInteger('is_certificate_ownership_r')->nullable();
            $table->tinyInteger('is_planningcertificate_r')->nullable();
            $table->tinyInteger('is_situation_plan_r')->nullable();
            $table->tinyInteger('is_explanatory_report_r')->nullable();
            $table->tinyInteger('is_commitment_complete_r')->nullable();
            $table->tinyInteger('is_commitment_follow_r')->nullable();
            $table->tinyInteger('is_statusproject_r')->nullable();
            $table->tinyInteger('is_residential_subdivision_p')->nullable();
            $table->tinyInteger('is_commercial_subdivision_p')->nullable();
            $table->tinyInteger('is_industrial_subdivision_p')->nullable();
            $table->tinyInteger('is_mixed_siubdivision_p')->nullable();
            $table->string('more_information_p', 45)->nullable();
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
            $table->string('area_tosubdivide_unit_g', 15)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('autorizationtontosubdivide');
    }
}
