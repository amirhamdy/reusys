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
        Schema::create('tasks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->date('start_date');
            $table->date('delivery_date');
            $table->integer('amount');
            $table->boolean('is_paid');
            $table->text('notes');
            $table->boolean('is_minimum_charge_used');
            $table->boolean('send_details_to_resource');
            $table->unsignedBigInteger('job_id');
            $table->unsignedBigInteger('task_type_id');
            $table->unsignedBigInteger('task_unit_id');
            $table->unsignedBigInteger('subject_matter_id');
            $table->unsignedBigInteger('task_status_id');
            $table->unsignedBigInteger('translator_id');

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
        Schema::dropIfExists('tasks');
    }
};
