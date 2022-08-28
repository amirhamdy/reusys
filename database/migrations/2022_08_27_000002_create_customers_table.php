<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->string('fax');
            $table->string('website');
            $table->string('address');
            $table->string('postal_code');
            $table->string('city');
            $table->string('billing_address');
            $table->unsignedBigInteger('country_id');
            $table->unsignedBigInteger('region_id');
            $table->unsignedBigInteger('industry_id');
            $table->unsignedBigInteger('customer_rating_id');
            $table->unsignedBigInteger('customer_status_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
};
