<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class ProjectTableSeeder extends Seeder
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
		
        foreach(range(1,5) as $index)  
        {  
			DB::table('projects')->insert([
                'name' => str_replace('.', '_', $faker->unique()->name),  
                'slug' => $faker->lexify('?????'),
                'description' => $faker->paragraph(1),  
                'category' => $faker->randomElement($array = array ('social','ambiental','economic')),  
                'profile_media_id' => rand(1,20),  
                'cover_media_id' => rand(1,20),  
                'hashtag' => str_random(10), 
                'created_at' => $faker->dateTimeThisMonth(),  
                'updated_at' => $faker->dateTimeThisMonth(),  
            ]);  
        }		
    }
}
