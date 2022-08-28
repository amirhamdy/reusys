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
        Schema::table('projects', function (Blueprint $table) {
            $table
                ->foreign('productline_id')
                ->references('id')
                ->on('productlines')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('currency_id')
                ->references('id')
                ->on('currencies')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropForeign(['productline_id']);
            $table->dropForeign(['currency_id']);
        });
    }
};
