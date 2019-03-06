@extends('layouts.app')

@section('content')

	@php
		/** @var \App\Post $post */
	@endphp

	@include('layouts.errors')
	@include('layouts.success')

	<form id="post-update" method="POST" action="{{ route('posts.update', $post->id) }}" enctype="multipart/form-data">
		@method('PATCH')
		@csrf

		<div class="container columns is-desktop">
			<div class="column">
				@include('posts.includes.post_edit_main_col')
			</div>
			<div class="column is-narrow">
				@include('posts.includes.post_edit_right_col')
			</div>
		</div>
	</form>

	{{--Кнопка для видалення всередині @include('posts.includes.post_edit_right_col')--}}
	<form id="post-delete" method="POST" action="{{ route('posts.destroy', $post->id) }}">
		@csrf
		@method('DELETE')
	</form>




	<script>
		CKEDITOR.replace( 'editor' );

		var file = document.getElementById("file-image");
		file.onchange = function(){
			if(file.files.length > 0)
			{
				document.getElementById('file-image-name').innerHTML = file.files[0].name;
			}
		};
	</script>

@endsection