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
	
	public function ismember($user,$role = NULL) {
		if (!$user) return FALSE;
		
		if (is_null($role))
		{
			return ($this->members()->where('user_id', $user->id)->get()->count() > 0);
		} 
		else 
		{
			return ($this->members()->where('user_id', $user->id)->where('role',$role)->get()->count() > 0);
		}
	}

	public function likes()
	{
		return $this->belongsToMany('App\Models\Access\User\User','project_likes')->withTimestamps();
	}

	public function hasliked($user) {
		if (!$user) return FALSE;
		
		return ($this->likes()->where('user_id', $user->id)->get()->count() > 0);
	}

	public function views()
	{
		return $this->belongsToMany('App\Models\Access\User\User','project_views')->withTimestamps();
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
