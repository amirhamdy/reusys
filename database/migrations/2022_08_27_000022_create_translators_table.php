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
            $table->integer('experience')->nullable();
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
            $table->boolean('nda')->default(0);
            $table->boolean('cv')->default(0);
            $table->unsignedBigInteger('translator_type_id');
            $table->unsignedBigInteger('native_language_id')->nullable();
            $table->unsignedBigInteger('second_language_id')->nullable();
            $table->unsignedBigInteger('country_id');
            $table->unsignedBigInteger('currency_id');

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
        Schema::dropIfExists('translators');
    }
};
