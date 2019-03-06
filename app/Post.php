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

	/**
	 * Користувач, який відноситься до посту
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user()
	{
		return $this->belongsTo(User::class);
	}


	public function comments()
	{
		return $this->morphMany(Comment::class, 'commentable')->where('parent_id', 0);
	}
}
