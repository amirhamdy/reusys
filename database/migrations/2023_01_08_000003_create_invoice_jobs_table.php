<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_jobs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('amount');
            $table->decimal('cost', 10, 3);
            $table->decimal('cost_usd', 10, 3);
            $table->unsignedBigInteger('invoice_id');
            $table->unsignedBigInteger('job_id');

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
        Schema::dropIfExists('invoice_jobs');
    }
}
