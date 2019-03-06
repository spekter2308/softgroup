@extends('layouts.app')

@section('content')

	@include('layouts.success')

	<div class="container">

		<h1 class="title has-text-centered">
			Всі пости
		</h1>

			<nav class="navbar navbar-toggle-toggleleable-md navbar-light bg-faded" style="background: none;">
				<a class="btn btn-primary" href="{{route('posts.create') }}">Додати новий</a>
			</nav>
			<br>

		@foreach ($paginator as $post)
			@php
				/** @var \App\Post $post */
			@endphp
			<div class="box"
				 @if ($post->deleted_at)
					style="background: tomato;"
				 @endif>
				<h1 class="title">
					<a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a>
				</h1>
				<div class="level-left border-bottom border-top" style="padding: 5px 0; color: #ccc;">
					<p class="level-item" style="border-right: 1px solid #ccc; padding-right: 15px;">
						Автор: {{ $post->user->name }}
					</p>
					<p class="level-item" style="border-right: 1px solid #ccc; padding-right: 15px;">
						Дата публікації: {{ $post->published_at ? \Carbon\Carbon::parse($post->published_at)->format('d M Y') : ''}}
					</p>
					<p class="level-item">
						Коментарів:
					</p>
				</div>
				<br>
				<article class="media">
					<div class="media-left desktop column is-6">
						<a href="{{ route('posts.show', $post->id) }}">
							<img src="/storage/cover_images/{{ $post->cover_image }}" height="600px" width="900px">
						</a>
					</div>
					<div class="media-content">
						<div class="content">
							<br>
							<p>
								{{ $post->excerpt }}
							</p>
							<div class="field">
								<div class="control has-text-centered">
									<a class="btn btn-primary" href="{{route('posts.show', $post->id) }}">Читати
										далі</a>
								</div>
							</div>

						</div>
					</div>
				</article>
			</div>
		@endforeach

		@if($paginator->total() > $paginator->count())
			<br>
			<nav class="pagination" role="navigation" aria-label="pagination">
				{{ $paginator->links() }}
			</nav>
		@endif

	</div>

@endsection