<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeColumnChangesAndDropToJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jobs', function (Blueprint $table) {
			$table->dropcolumn('project_url_exact');
			$table->dropcolumn('project_url_brand_plus_exact');
			$table->dropcolumn('project_url_secondary_plus_exact');
			$table->dropcolumn('project_url_partial_plus_exact');
			$table->dropcolumn('project_url_partial_plus_brand');
			$table->dropcolumn('project_url_capitalize_percentage');
			$table->dropcolumn('project_url_country_percentage');
			$table->dropcolumn('project_url_yes_percentage');
			$table->dropcolumn('project_url_no_percentage');
			$table->dropcolumn('project_url_length_of_job');
			$table->dropcolumn('project_url_random_job');
			$table->dropcolumn('project_url_minimum_range');
			$table->dropcolumn('project_url_maximum_range');
         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jobs', function (Blueprint $table) {
            //
        });
    }
}
