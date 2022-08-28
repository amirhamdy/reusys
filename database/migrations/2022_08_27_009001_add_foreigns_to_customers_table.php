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
        Schema::table('customers', function (Blueprint $table) {
            $table
                ->foreign('country_id')
                ->references('id')
                ->on('countries')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('region_id')
                ->references('id')
                ->on('regions')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('industry_id')
                ->references('id')
                ->on('industries')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('customer_rating_id')
                ->references('id')
                ->on('customer_ratings')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('customer_status_id')
                ->references('id')
                ->on('customer_statuses')
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
        Schema::table('customers', function (Blueprint $table) {
            $table->dropForeign(['country_id']);
            $table->dropForeign(['region_id']);
            $table->dropForeign(['industry_id']);
            $table->dropForeign(['customer_rating_id']);
            $table->dropForeign(['customer_status_id']);
        });
    }
};
