<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
	protected $guarded = [];

	public function project()
	{
		return $this->belongsTo('App\Models\Project');
	}
}
