<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
	protected $guarded = [];
	protected $table = 'medias';
		
	static function url($media, $style = array(), $default = NULL) {
		if ($media && (get_class($media) == 'App\Models\Media') && isset($media->public_id)) {
			return cloudinary_url($media->public_id, $style);
		} else {
			if ($default && is_string($default)) {
				return cloudinary_url($default, $style);
			}
		}
		return FALSE;
	}
}
