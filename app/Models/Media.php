<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
	protected $guarded = [];
	protected $table = 'medias';
	
	public function url($style = array()) 
	{
		return cloudinary_url($this->public_id, $style);
	}
}
