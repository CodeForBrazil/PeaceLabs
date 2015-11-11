<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FillProjectSlugColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

		$projects = DB::table('projects')->get();
		foreach($projects as $project) {
//			$project_id = $project->id;
		    DB::table('projects')
		            ->where('id', $project->id)
		            ->update(['slug' => str_slug($project->name)]);
		}
		/*
		$projects = App\Models\Project::all();
		
		foreach($projects as $project) {
		    $project->slug =  str_slug($project->name, "-");
		    $projects->save();
		}    */
	}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
