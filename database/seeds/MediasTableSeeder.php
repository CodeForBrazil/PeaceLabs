<?php

use Illuminate\Database\Seeder;

//use Cloudinary;

class MediasTableSeeder extends Seeder
{
    public function run()
    {
        // Uncomment the below to wipe the table clean before populating
        DB::table('medias')->delete();

 		$medias = array();
        foreach(range(1,20) as $id) {
			$image = \Cloudinary\Uploader::upload("http://lorempixel.com/1024/720/?82533");	
        	$medias[] = ['public_id' => $image['public_id'], 'created_at' => new DateTime, 'updated_at' => new DateTime];
        } 
 
        //// Uncomment the below to run the seeder
        DB::table('medias')->insert($medias);    
	}
}
