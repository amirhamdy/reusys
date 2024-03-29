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
            $table->enum('status', ['Not Started', 'In Progress', 'Completed']);
            $table->integer('amount');
            $table
                ->enum('is_paid', ['Paid', 'Not Paid', 'Waived Cost'])
                ->default('Not Paid');
            $table->float('cost');
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
