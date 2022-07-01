<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request', function (Blueprint $table) {
            $table->string('no_request', 45)->primary();
            $table->string('requestcol', 45)->nullable();
            $table->tinyInteger('type_buildingpermit')->nullable()->default(0);
            $table->tinyInteger('type_planningcertificate')->nullable()->default(0);
            $table->tinyInteger('type_implantationpermit')->nullable()->default(0);
            $table->tinyInteger('type_autorizationtontosubdivide')->nullable()->default(0);
            $table->tinyInteger('type_demolitionpermit')->nullable()->default(0);
            $table->tinyInteger('type_certificateofconformity')->nullable()->default(0);
            $table->timestamp('date_request')->useCurrent();
            $table->tinyInteger('progress')->nullable();
            $table->tinyInteger('pending')->nullable();
            $table->tinyInteger('completed')->nullable();
            $table->integer('user_id_user')->nullable()->index('fk_request_user_idx');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('request');
    }
}
