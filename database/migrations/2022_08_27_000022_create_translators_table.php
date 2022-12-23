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
        Schema::create('translators', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('degree')->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('nationality')->nullable();
            $table->string('experience')->nullable();
            $table->string('id_number')->nullable();
            $table->string('vat_number')->nullable();
            $table->string('id_other')->nullable();
            $table->string('timezone')->nullable();
            $table->string('website')->nullable();
            $table->string('skype')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('payment_after');
            $table->string('email')->nullable();
            $table->boolean('nda')->default(0);
            $table->boolean('cv')->default(0);
            $table->string('native_language')->nullable();
            $table->string('second_language')->nullable();
            $table->unsignedBigInteger('translator_type_id');
            $table->unsignedBigInteger('country_id');
            $table->unsignedBigInteger('currency_id');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('translators');
    }
};
