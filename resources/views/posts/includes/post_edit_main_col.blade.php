@php
	/** @var \App\Post $post */
@endphp

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
							   value="{{ $post->title }}">
					</div>
				</div>

				<div class="field">
					<label class="label" for="slug">Ідентифікатор (slug)</label>

					<div class="control">
						<input type="slug"
							   class="form-control"
							   name="slug"
							   value="{{ $post->slug }}">
					</div>
				</div>

				<div class="field">
					<label class="label" for="excerpt">Короткий опис</label>

					<div class="control" >
								<textarea id="excerpt"
										  name="excerpt"
										  class="textarea"
										  rows="3">{{ $post->excerpt }}
								</textarea>
					</div>
				</div>

				<div class="field">
					<label class="label" for="content_html">Опис</label>

					<div class="control" >
								<textarea id="editor"
										  name="content_html"
										  class="textarea"
										  rows="3">{{ $post->content_html }}
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

			</div>
		</div>
	</div>
</div>