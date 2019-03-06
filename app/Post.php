<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $guarded = [];

	/**
	 * Отримати зображення для галереї
	 */
    /*public function image()
	{
		return $this->morphOne(Image::class, 'imageable');
	}*/

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
