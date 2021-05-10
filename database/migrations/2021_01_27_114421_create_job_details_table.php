<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_details', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->integer('project_url_id');
			$table->integer('project_url_weight');
			$table->integer('project_url_exact');
			$table->integer('project_url_brand_plus_exact');
			$table->integer('project_url_secondary_plus_exact');
			$table->integer('project_url_partial_plus_exact');
			$table->integer('project_url_partial_plus_brand');
			$table->integer('project_url_capitalize_percentage');
			$table->integer('project_url_country_percentage');
			$table->integer('project_url_yes_percentage');
			$table->integer('project_url_no_percentage');
			$table->string('project_url_length_of_job');
			$table->integer('project_url_random_job')->default(0);
			$table->integer('project_url_minimum_range');
			$table->integer('project_url_maximum_range');
			$table->integer('created_by_user')->default(0);
			$table->integer('updated_by_user')->default(0);
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
        Schema::dropIfExists('job_details');
    }
}
