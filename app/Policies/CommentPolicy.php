<?php

namespace App\Policies;

use App\User;
use App\Comment;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create comments.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
		foreach ($user->roles as $role) {
			if($role->name == 'admin' OR $role->name == 'user'){
				return true;
			}
		}
		return false;
    }

    /**
     * Determine whether the user can update the comment.
     *
     * @param  \App\User  $user
     * @param  \App\Comment  $comment
     * @return mixed
     */
    public function update(User $user, Comment $comment)
    {
		foreach ($user->roles as $role) {
			if ($role->name == 'admin') {
				return true;
			}
		}
		if($user->id == $comment->user_id){
			return true;
		}
		return false;
	}

    /**
     * Determine whether the user can delete the comment.
     *
     * @param  \App\User  $user
     * @param  \App\Comment  $comment
     * @return mixed
     */
    public function delete(User $user, Comment $comment)
	{
		foreach ($user->roles as $role) {
			if ($role->name == 'admin') {
				return true;
			}
		}
		if($user->id == $comment->user_id){
			return true;
		}
		return false;
	}
}
