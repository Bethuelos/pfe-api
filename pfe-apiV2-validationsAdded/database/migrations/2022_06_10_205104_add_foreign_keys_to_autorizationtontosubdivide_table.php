<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToAutorizationtontosubdivideTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('autorizationtontosubdivide', function (Blueprint $table) {
            $table->foreign(['request_no_request'], 'fk_planningcertificate_request10')->references(['no_request'])->on('request')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('autorizationtontosubdivide', function (Blueprint $table) {
            $table->dropForeign('fk_planningcertificate_request10');
        });
    }
}
