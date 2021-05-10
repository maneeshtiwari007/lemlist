<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfigureCrawlersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configure_crawlers', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->string('username');
			$table->string('password');
			$table->string('access_token');
			$table->string('expires_in');
			$table->string('token_type');
			$table->string('created_at_token');
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
        Schema::dropIfExists('configure_crawlers');
    }
}
