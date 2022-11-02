<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->enum('status', ['Not Started', 'In Progress', 'Completed']);
            $table->integer('amount');
            $table
                ->enum('is_paid', ['Paid', 'Not Paid', 'Waived Cost'])
                ->default('Not Paid');
            $table->float('cost');
            $table->boolean('is_free_task');
            $table->boolean('is_minimum_charge_used');
            $table->date('payment_date')->nullable();
            $table->text('notes')->nullable();
            $table->unsignedBigInteger('job_id');
            $table->unsignedBigInteger('task_type_id');
            $table->unsignedBigInteger('task_unit_id');
            $table->unsignedBigInteger('subject_matter_id');
            $table->unsignedBigInteger('translator_id');

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
        Schema::dropIfExists('tasks');
    }
};
