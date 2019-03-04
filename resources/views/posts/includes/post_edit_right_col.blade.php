@php
	/** @var \App\Post $post */
@endphp

<div class="card has-text-centered">
	<div class="card-content">
		<div class="field">
			<div class="control has-text-centered">
				<button type="submit" class="button is-link" form="post-update">Зберегти</button>
			</div>
		</div>



		<br>
		@if($post->exists)
			<ul class="list-unstyled">
				<li>
					ID: {{ $post->id }}
				</li>
			</ul>
			<br>

			<div class="field">
				<label class="label" for="created_at">Створено</label>

				<div class="control">
					<input type="text" class="input has-text-centered" name="created_at" value="{{ $post->created_at
					}}"
						   disabled>
				</div>
			</div>

			<div class="field">
				<label class="label" for="updated_at">Змінено</label>

				<div class="control">
					<input type="text" class="input has-text-centered" name="updated_at" value="{{ $post->updated_at
					}}"
						   disabled>
				</div>
			</div>

			<div class="field">
				<label class="label" for="deleted_at">Видалено</label>

				<div class="control">
					<input type="text" class="input has-text-centered" name="deleted_at" value="{{ $post->deleted_at
					}}"
						   disabled>
				</div>
			</div>
			<br>

			{{--Для форми видалення--}}
			<div class="field">
				<div class="control has-text-centered">
					<button type="submit" class="button is-link" form="post-delete">Видалити</button>
				</div>
			</div>
		@endif
	</div>
</div>