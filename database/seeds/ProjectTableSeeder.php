<?php

use Illuminate\Database\Seeder;

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

        DB::table('projects')->truncate();
		
        foreach(range(1,30) as $index)  
        {  
			DB::table('projects')->insert([
                'name' => str_replace('.', '_', $faker->unique()->userName),  
                'description' => $faker->paragraph(1),  
                'category' => $faker->randomElement($array = array ('a','b','c')),  
                'profile' => $faker->imageUrl($width = 300, $height = 300),  
                'cover' => $faker->imageUrl($width = 1024, $height = 720),  
                'hashtag' => str_random(10), 
                'created_at' => $faker->dateTimeThisMonth(),  
                'updated_at' => $faker->dateTimeThisMonth(),  
            ]);  
        }		
    }
}
