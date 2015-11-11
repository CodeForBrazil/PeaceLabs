<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatesMediasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medias', function (Blueprint $table) {
            $table->increments('id');
			$table->string('public_id',50);
            $table->timestamps();
        });

		Schema::table('projects', function ($table) {
			$table->integer('profile_media_id')->unsigned()->nullable()->after('cover');
			$table->foreign('profile_media_id')->references('id')->on('medias')->onDelete('cascade');
			$table->integer('cover_media_id')->unsigned()->nullable()->after('profile_media_id');
			$table->foreign('cover_media_id')->references('id')->on('medias')->onDelete('cascade');
			$table->dropColumn('profile');
			$table->dropColumn('cover');
		});

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::table('projects', function ($table) {
			$table->dropForeign('projects_profile_media_id_foreign');
			$table->dropForeign('projects_cover_media_id_foreign');
			$table->dropColumn('profile_media_id');
			$table->dropColumn('cover_media_id');
            $table->string('profile')->nullable();
            $table->string('cover')->nullable();
		});
        Schema::drop('medias');
    }
}
