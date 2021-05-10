<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewKeywordColumnChangesToJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->integer('project_url_exact')->after('project_url_weight');
			$table->integer('project_url_brand_plus_exact')->after('project_url_exact');
			$table->integer('project_url_secondary_plus_exact')->after('project_url_brand_plus_exact');
			$table->integer('project_url_partial_plus_exact')->after('project_url_secondary_plus_exact');
			$table->integer('project_url_partial_plus_brand')->after('project_url_partial_plus_exact');
			$table->integer('project_url_capitalize_percentage')->after('project_url_partial_plus_brand');
			$table->integer('project_url_country_percentage')->after('project_url_capitalize_percentage');
			$table->integer('project_url_yes_percentage')->after('project_url_country_percentage');
			$table->integer('project_url_no_percentage')->after('project_url_yes_percentage');
			$table->string('project_url_length_of_job')->after('project_url_no_percentage');
			$table->integer('project_url_random_job')->default(0)->after('project_url_length_of_job');
			$table->integer('project_url_minimum_range')->after('project_url_random_job');
			$table->integer('project_url_maximum_range')->after('project_url_minimum_range');
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
