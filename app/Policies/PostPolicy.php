<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

	/**
	 * Право на додавання тільки у адміна і редактора
	 * @param $user
	 * @return bool
	 */
    public function add($user)
	{
		foreach ($user->roles as $role) {
			if($role->name == 'admin' OR $role->name == 'editor'){
				return true;
			}
		}
		return false;
	}

	/**
	 * Право на оновлення
	 * @param $user
	 * @param $post
	 * @return bool
	 */
	public function update($user, $post)
	{
		foreach ($user->roles as $role) {
			if($role->name == 'admin'){
				return true;
			}
			if($role->name == 'editor'){
				if($user->id == $post->user_id){
					return true;
				}
			}
		}
		return false;
	}

	/**
	 * Право на видалення
	 * @param $user
	 * @param $post
	 * @return bool
	 */
	public function delete($user, $post)
	{
		foreach ($user->roles as $role) {
			if($role->name == 'admin'){
				return true;
			}
			if($role->name == 'editor'){
				if($user->id == $post->user_id){
					return true;
				}
			}
		}
		return false;
	}
}
