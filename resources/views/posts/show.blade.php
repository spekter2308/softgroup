@extends('layouts.app')

@section('content')

	@php
		/** @var \App\Post $post */
	@endphp

	<div class="container">
		<div class="field">
			<a href="/posts" class="button">Назад</a>
		</div>

		<div class="card">

			<div class="card-content border-bottom">
				<div class="media">
					<div class="media-left">
						<figure class="image is-128x128">
							<img class="is-rounded" src="https://bulma.io/images/placeholders/128x128.png">
						</figure>
					</div>
					<div class="media-content" style="margin: auto 10px;">
						<p class="title is-4">{{ $post->user_id }}</p>
					</div>
				</div>
			</div>

			<h1 class="title column is-four-fifths has-text-centered"">
				{{ $post->title }}
			</h1>

			<div class="card-image">
				<figure class="image is-4by3">
					<img src="https://bulma.io/images/placeholders/1280x960.png" alt="Placeholder image">
				</figure>
			</div>
		</div>

		<div class="media-content">
			<div class="content">
				<br>

					{!!$post->content_html!!}

				<div class="field">
						<a class=" btn btn-primary" href="{{route('posts.edit', $post->id) }}">Редагувати</a>
				</div>

			</div>
		</div>
		<br><br>
		{{--comment part--}}
		<article class="media">
			<figure class="media-left">
				<p class="image is-64x64">
					<img src="https://bulma.io/images/placeholders/128x128.png">
				</p>
			</figure>
			<div class="media-content">
				<div class="field">
					<p class="control">
						<textarea class="textarea" placeholder="Add a comment..." rows="3"></textarea>
					</p>
				</div>
				<nav class="level">
					<div class="level-left">
						<div class="level-item">
							<a class="button is-info">Залиште коментар</a>
						</div>
					</div>
					<div class="level-right">
						<div class="level-item">
							<label class="checkbox">
								<input type="checkbox"> Press enter to submit
							</label>
						</div>
					</div>
				</nav>
			</div>
		</article>
		
		Edit  Delete (for roles)

		Display Comments
		Input
		Add comment
			Photo Name
			Comment
				likes
				input
				reply
					Photo Name
					Comment
						likes
						input
						reply



	</div>

@endsection