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
        Schema::table('opportunities', function (Blueprint $table) {
            $table
                ->foreign('productline_id')
                ->references('id')
                ->on('productlines')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('source_language_id')
                ->references('id')
                ->on('languages')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('target_language_id')
                ->references('id')
                ->on('languages')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('opportunity_type_id')
                ->references('id')
                ->on('opportunity_types')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('opportunity_unit_id')
                ->references('id')
                ->on('opportunity_units')
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
        Schema::table('opportunities', function (Blueprint $table) {
            $table->dropForeign(['productline_id']);
            $table->dropForeign(['source_language_id']);
            $table->dropForeign(['target_language_id']);
            $table->dropForeign(['opportunity_type_id']);
            $table->dropForeign(['opportunity_unit_id']);
        });
    }
};
