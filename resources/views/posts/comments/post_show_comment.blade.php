<h3 class="title is-3">Коментарі</h3>

@include('posts.comments._comment_replies', ['comments' => $post->comments, 'post_id' => $post->id])

{{--Add comment--}}
<form method="POST" action="{{ route('comment.AddPostComment', $post->id) }}">
	@csrf
	<article class="media" style="padding-top: 10px;">
		<figure class="media-left">
			<p class="image is-64x64">
				<img src="/storage/cover_images/user/user_noimage.jpg">
			</p>
		</figure>
		<div class="media-content">
			{{--Comment--}}
			<div class="field">
				<p class="control">
					<textarea class="textarea" placeholder="Add a comment..." type="text" name="comment"></textarea>
				</p>
			</div>
			<div class="field">
				<div class="control">
					<input type="hidden" name="post_id" value="{{ $post->id }}">
				</div>
			</div>

			<div class="field">
				<p class="control">
					<button class="button">Додати коментар</button>
				</p>
			</div>
		</div>
	</article>
</form>

<script>
	var buttonsShow = document.querySelectorAll('.showModal');
	var buttonsClose = document.querySelectorAll('.closeModal');
	buttonsShow.forEach(function(buttonShow) {

		buttonShow.addEventListener('click', function() {
			var postId = this.getAttribute('showModal')
			console.log(postId)
			document.getElementById('page-modal-' + postId).style.display = 'block'
		})
	});

	buttonsClose.forEach(function(buttonClose) {

		buttonClose.addEventListener('click', function() {
			var postId = this.getAttribute('closeModal')
			console.log(postId)
			document.getElementById('page-modal-' + postId).style.display = 'none'
		})
	});
</script>