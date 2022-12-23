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
        Schema::create('pricelists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('subject_matter_id');
            $table->unsignedBigInteger('job_type_id');
            $table->unsignedBigInteger('job_unit_id');
            $table->unsignedBigInteger('source_language_id');
            $table->unsignedBigInteger('target_language_id');
            $table->unsignedBigInteger('pricebook_id');
            $table->decimal('unit_price', 10, 3);
            $table->decimal('minimum_charge', 10, 3)->default(0)->nullable();

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
        Schema::dropIfExists('pricelists');
    }
};
