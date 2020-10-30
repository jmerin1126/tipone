<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
			
			$table->string('name')->nullable(false)->primary();
			$table->string('email')->unique();
			$table->string('logo');
			$table->string('website')->unique();
            $table->bigIncrements('id');
            $table->timestamps();
			$table->dropPrimary('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
    }
}
