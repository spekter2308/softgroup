<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

	/**
	 * Отримати зображення користувача
	 */
    /*public function image()
	{
		return $this->morphOne(Image::class, 'imageable');
	}*/

	/**
	 * Отримати всі пости користувача
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function posts()
	{
		return $this->hasMany(Post::class);
	}

	/**
	 * Користувач відноситься до ролі через зв'язуючу таблицю
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function roles()
	{
		return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id');
	}

}
