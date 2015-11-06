<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
	protected $guarded = [];

	public function tasks()
	{
		return $this->hasMany('App\Models\Task');
	}
	
	public function profile() 
	{
		return $this->hasOne('App\Models\Media', 'id', 'profile_media_id');
	}

	public function cover() 
	{
		return $this->belongsTo('App\Models\Media','cover_media_id','id');
	}
	
}
