@foreach ($comments as $comment)
	{{--Main comment--}}
	<article class="media border-top" style="padding-top: 10px;">
		<figure class="media-left">
			<p class="image is-64x64">
				<img src="/storage/cover_images/user/user_noimage.jpg">
			</p>
		</figure>
		<div class="media-content">
			<div class="content">
				<p>
					<strong>{{ $comment->user->name }}</strong>
					<br>
					{{ $comment->comment }}
					<br>
					<small><a reply="{{$comment->id}}" class="button is-link replyButton">Відповісти</a></small>
				</p>
				{{--Edit Delete Main Comment--}}
				<div class="d-flex" style="padding: 20px 10px;">
					<a showModal="{{$comment->id}}" class="button is-link showModal" style="color: white">Редагувати</a>
					<div class="modal" id="page-modal-{{$comment->id}}">
						<div class="modal-background"></div>
						<div class="modal-card" style="top: 30%;">
							<form method="POST" action="{{ route('comment.update', $comment->id) }}">
								@csrf
								@method('PATCH')
								<section class="modal-card-body">
									<div class="field">
										<label class="label" for="comment"></label>

										<div class="control">
											<input type="text" class="input" name="comment" value="{{ $comment->comment }}">
										</div>
									</div>

								</section>
								<footer class="modal-card-foot">
									<div class="d-inline-flex">
										<div class="field">
											<div class="control">
												<button type="submit" class="button is-link">Зберегти</button>
											</div>
										</div>
										<a class="button closeModal" id="closeModal" closeModal="{{$comment->id}}">Відмінити</a>
									</div>
								</footer>
							</form>
						</div>
					</div>

					<span style="margin: 5px;"></span>
					<form method="POST" action="{{ route('comment.destroy', $comment->id) }}">
						@csrf
						@method('DELETE')

						<div class="field">
							<div class="control">
								<button type="submit" class="button is-danger">Видалити</button>
							</div>
						</div>
					</form>
				</div>
			</div>


			{{--reply form--}}
			<form method="POST" action="{{ route('comment.AddCommentReply', $comment->id) }}">
				@csrf
				<article id="reply-page-{{$comment->id}}" class="media" style="padding-top: 10px; display: none;">
					<div class="media-content">
						{{--Comment--}}
						<div class="field">
							<p class="control">
									<textarea class="input" placeholder="Відповісти..." type="text"
											  name="comment"></textarea>
							</p>
						</div>
						<div class="field">
							<div class="control">
								<input type="hidden" name="post_id" value="{{ $post->id }}">
							</div>
						</div>

						<div class="field">
							<p class="control">
								<button class="button">Додати відповідь</button>
							</p>
						</div>
						<a reply-close="{{$comment->id}}" class="button replyClose">Відміна</a>
					</div>
				</article>
			</form>


			@if (count($comment->replies))
					@include('posts.comments._comment_replies', ['comments' => $comment->replies])
			@endif
	</div>
</article>

@endforeach

<script>
	var buttonsReply = document.querySelectorAll('.replyButton');
	var buttonsCloseReply = document.querySelectorAll('.replyClose');
	buttonsReply.forEach(function(buttonReply) {

		buttonReply.addEventListener('click', function() {
			var commentId = this.getAttribute('reply')
			console.log(commentId)
			document.getElementById('reply-page-' + commentId).style.display = 'block'
		})
	});

	buttonsCloseReply.forEach(function(buttonCloseReply) {

		buttonCloseReply.addEventListener('click', function() {
			var commentId = this.getAttribute('reply-close')
			console.log(commentId)
			document.getElementById('reply-page-' + commentId).style.display = 'none'
		})
	});

</script>