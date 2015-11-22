<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;
use App\Models\Access\User\User as User;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$faker = Faker\Factory::create();

        DB::table('projects')->delete();
		
		$media_id = DB::table('medias')->orderBy('id','asc')->first()->id;
		
        foreach(range(1,5) as $index)  
        {  
			$id = DB::table('projects')->insertGetId([
                'name' => str_replace('.', '_', $faker->unique()->name),  
                'slug' => $faker->lexify('?????'),
                'description' => $faker->paragraph(1),  
                'category' => $faker->randomElement($array = array ('social','ambiental','economic')),  
                'profile_media_id' => rand($media_id,$media_id+20),  
                'cover_media_id' => rand($media_id,$media_id+20),  
                'hashtag' => str_random(10), 
                'created_at' => $faker->dateTimeThisMonth(),  
                'updated_at' => $faker->dateTimeThisMonth(),  
            ]);
            DB::table('project_users')->insert([
            	'user_id' => User::orderByRaw("random()")->first()->id,
            	'project_id' => $id,
            	'role' => 'owner',
            	'created_at' => new DateTime, 'updated_at' => new DateTime
			]); 
        }		
    }
}
