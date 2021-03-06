@extends('layouts.app')

@section('content')

	@php
		/** @var \App\Post $post */
	@endphp

	@include('layouts.errors')

		<form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
		@csrf

		<div class="container">
			<div class="card">
				<div class="card-content">
					<div class="tabs">
						<ul>
							<li class="is-active"><a>Основні дані</a></li>
						</ul>
					</div>
					<br>
					<div class="tab-content">
						<div class="tab-panel active" id="maindata" role="tabpanel">

							<div class="field">
								<label class="label" for="title">Заголовок</label>

								<div class="control">
									<input type="title"
										   class="form-control"
										   name="title"
										   value="{{ old('title') }}">
								</div>
							</div>

							<div class="field">
								<label class="label" for="slug">Ідентифікатор (slug)</label>

								<div class="control">
									<input type="slug"
										   class="form-control"
										   name="slug"
										   value="{{ old('slug') }}">
								</div>
							</div>

							<div class="field">
								<label class="label" for="excerpt">Короткий опис</label>

								<div class="control" >
								<textarea id="excerpt"
										  name="excerpt"
										  class="textarea"
										  rows="3">{{ old('excerpt') }}
								</textarea>
								</div>
							</div>

							<div class="field">
								<label class="label" for="content_html">Опис</label>

								<div class="control" >
								<textarea id="editor"
										  name="content_html"
										  class="textarea"
										  rows="3">{{ old('content_html') }}
								</textarea>
								</div>
							</div>

							<div class="field">
								<div class="file is-right is-info">
									<label class="file-label">
										<input class="file-input" type="file" name="cover_image" id="file-image">
										<span class="file-cta">
											<span class="file-icon">
												<i class="fas fa-upload"></i>
											</span>
											<span class="file-label">
											  	Зображення
											</span>
										  </span>
										<span id="file-image-name" class="file-name"></span>
									</label>
								</div>
							</div>
							<br>

							<div class="field">
								<div class="control has-text-centered">
									<button type="submit" class="button is-link">Зберегти пост</button>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>

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