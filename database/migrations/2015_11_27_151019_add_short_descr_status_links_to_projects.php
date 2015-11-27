<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddShortDescrStatusLinksToProjects extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->string('description_short')->after('description')->default('');
            $table->string('status')->nullable();
            $table->string('url_1')->nullable();
            $table->string('url_2')->nullable();
            $table->string('url_3')->nullable();
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
			$table->dropColumn('description_short');
			$table->dropColumn('status');
            $table->dropColumn('url_1');
            $table->dropColumn('url_2');
            $table->dropColumn('url_3');
            //
        });
    }
}
