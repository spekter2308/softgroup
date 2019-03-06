@extends('layouts.app')

@section('content')

	@include('layouts.success')

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
							<img class="is-rounded" src="/storage/cover_images/user/user_noimage.jpg">
						</figure>
					</div>
					<div class="media-content" style="margin: auto 10px;">
						<p class="title is-4">{{ $post->user->name }}</p>
					</div>
				</div>
			</div>

			<h1 class="title column is-four-fifths has-text-centered">
				{{ $post->title }}
			</h1>

			<div class="card-image">
				<figure class="image is-4by3">
					<img src="/storage/cover_images/{{ $post->cover_image }}" height="960px" width="1280px">
				</figure>
			</div>
		</div>

		<div class="media-content">
			<div class="content">
				<br>
					{!!$post->content_html!!}
				<br><br>

				<div class="field">
						<a class=" btn btn-primary" href="{{route('posts.edit', $post->id) }}">Редагувати</a>
				</div>

			</div>
		</div>
		<br><br>

		<div class="container">
			{{--comment part--}}
			@include('posts.comments.post_show_comment')
		</div>

	</div>

@endsection

