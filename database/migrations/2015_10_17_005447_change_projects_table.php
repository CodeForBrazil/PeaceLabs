<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::drop('projects');

        Schema::create('projects', function (Blueprint $table) {
			$table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->string('category')->nullable();
            $table->string('profile')->nullable();
            $table->string('cover')->nullable();
            $table->string('hashtag')->nullable();
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
		Schema::drop('projects');
    }
}
