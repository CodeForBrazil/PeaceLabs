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
	
	public function members()
	{
		return $this->belongsToMany('App\Models\Access\User\User','project_users')->withTimestamps();
	}
	
	public function profile() 
	{
		return $this->hasOne('App\Models\Media', 'id', 'profile_media_id');
	}

	public function cover() 
	{
		return $this->hasOne('App\Models\Media', 'id', 'cover_media_id');
	}

	public function profile_url($style = array()) 
	{
		return Media::url($this->profile,$style,getenv('CLOUDINARY_DEFAULT_PROFILE'));
	}

	public function cover_url($style = array()) 
	{
		return Media::url($this->cover,$style,getenv('CLOUDINARY_DEFAULT_COVER'));
	}
}
