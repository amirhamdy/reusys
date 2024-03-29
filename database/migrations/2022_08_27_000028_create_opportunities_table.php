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
        Schema::create('opportunities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->date('date');
            $table->text('description');
            $table->integer('amount');
            $table->integer('price');
            $table->string('probability_to_win');
            $table->string('status');
            $table->unsignedBigInteger('productline_id');
            $table->unsignedBigInteger('source_language_id');
            $table->unsignedBigInteger('target_language_id');
            $table->unsignedBigInteger('opportunity_type_id');
            $table->unsignedBigInteger('opportunity_unit_id');

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
        Schema::dropIfExists('opportunities');
    }
};
