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
        Schema::create('jobs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('amount')->default(1);
            $table->boolean('is_free_job');
            $table->boolean('is_minimum_charge_used');
            $table->decimal('cost', 10, 3);
            $table->decimal('cost_usd', 10, 3);
            $table->unsignedBigInteger('project_id');
            $table->unsignedBigInteger('source_language_id');
            $table->unsignedBigInteger('target_language_id');
            $table->unsignedBigInteger('job_type_id');
            $table->unsignedBigInteger('job_unit_id');

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
        Schema::dropIfExists('jobs');
    }
};
