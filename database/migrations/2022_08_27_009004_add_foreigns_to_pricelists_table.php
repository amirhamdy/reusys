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
        Schema::table('pricelists', function (Blueprint $table) {
            $table
                ->foreign('subject_matter_id')
                ->references('id')
                ->on('subject_matters')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('job_type_id')
                ->references('id')
                ->on('job_types')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('job_unit_id')
                ->references('id')
                ->on('job_units')
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
                ->foreign('pricebook_id')
                ->references('id')
                ->on('pricebooks')
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
        Schema::table('pricelists', function (Blueprint $table) {
            $table->dropForeign(['subject_matter_id']);
            $table->dropForeign(['job_type_id']);
            $table->dropForeign(['job_unit_id']);
            $table->dropForeign(['source_language_id']);
            $table->dropForeign(['target_language_id']);
            $table->dropForeign(['pricebook_id']);
        });
    }
};
