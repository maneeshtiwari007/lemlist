<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountryPercentagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('country_percentages', function (Blueprint $table) {
             $table->bigIncrements('id');
			 $table->integer('project_url_id');
			 $table->integer('job_detail_id');
			 $table->integer('job_id');
			 $table->string('country_code');
			 $table->integer('country_weight');
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
        Schema::dropIfExists('country_percentages');
    }
}
