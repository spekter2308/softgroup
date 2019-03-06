<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Comment;
use App\Post;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
	 * @param Post $post
     * @return \Illuminate\Http\Response
     */
    public function addPostComment(Request $request, Post $post)
    {
		$comment = new Comment;
		$comment->comment = $request->comment;
		$comment->user_id = auth()->user()->id;

		$post->comments()->save($comment);

		return back()->with(['success' => 'Коментар успішно додано']);
    }

	/**
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function AddCommentReply(Request $request, $id)
	{
		$this->validate($request, [
			'comment' => 'required'
		]);

		$reply = new Comment();
		$reply->comment = $request->comment;
		$reply->user_id = auth()->user()->id;
		$reply->parent_id = $id;
		$post = Post::find($request->get('post_id'));

		$post->comments()->save($reply);

		return back()->with(['success' => 'Відповідь на коментар додано']);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param Comment $comment
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Comment $comment)
	{
		$this->validate($request, [
			'comment' => 'required'
		]);

		$comment->update($request->all());

		return back()->with(['success' => 'Коментар успішно оновлено']);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param Comment $comment
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Comment $comment)
	{
		$comment->delete();

		return back()->with(['success' => 'Коментар успішно видалено']);
	}


}
