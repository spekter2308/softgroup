<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded = [];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
    public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function commentable()
	{
		return $this->morphTo();
	}

	public function replies()
	{
		return $this->hasMany(Comment::class, 'parent_id');
	}
}
