<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
	protected $guarded = [];

	/**
	 * Роль відноситься до користувачів через зв'язуючу таблицю
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function users()
	{
		return $this->belongsToMany(User::class, 'role_user', 'role_id', 'user_id');
	}
}
