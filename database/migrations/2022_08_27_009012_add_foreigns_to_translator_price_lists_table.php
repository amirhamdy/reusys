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
        Schema::table('translator_price_lists', function (Blueprint $table) {
            $table
                ->foreign('task_type_id')
                ->references('id')
                ->on('task_types')
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
                ->foreign('subject_matter_id')
                ->references('id')
                ->on('subject_matters')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('currency_id')
                ->references('id')
                ->on('currencies')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('task_unit_id')
                ->references('id')
                ->on('task_units')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('translator_id')
                ->references('id')
                ->on('translators')
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
        Schema::table('translator_price_lists', function (Blueprint $table) {
            $table->dropForeign(['task_type_id']);
            $table->dropForeign(['source_language_id']);
            $table->dropForeign(['target_language_id']);
            $table->dropForeign(['subject_matter_id']);
            $table->dropForeign(['currency_id']);
            $table->dropForeign(['task_unit_id']);
            $table->dropForeign(['translator_id']);
        });
    }
};
