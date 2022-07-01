<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer', function (Blueprint $table) {
            $table->integer('id_customer')->primary();
            $table->string('name', 30);
            $table->string('first_name', 30)->nullable();
            $table->string('email')->nullable();
            $table->date('boring_year')->nullable();
            $table->string('gender', 10)->nullable();
            $table->integer('phone_number')->nullable();
            $table->string('password');
            $table->string('address', 20)->nullable();
            $table->string('nationality', 30)->nullable();
            $table->string('postal_code', 25)->nullable();
            $table->timestamp('create_time')->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer');
    }
}
