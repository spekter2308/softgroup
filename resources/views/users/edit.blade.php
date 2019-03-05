@extends('layouts.app')

@section('content')

	@include('layouts.errors')

	@php
		/** @var \App\User $user */
		/** @var \App\Role $role */
	@endphp

	<form id="user-update" method="POST" action="{{ route('users.update', $user->id) }}">
		@method('PATCH')
		@csrf

		<div class="container">
			<div class="field">
				<label class="label" for="name">Ім'я</label>

				<div class="control">
					<input type="text" class="input" name="name" value="{{ $user->name }}">
				</div>
			</div>

			<div class="field">
				<label class="label" for="email"></label>

				<div class="control">
					<input type="text" class="input" name="email" value="{{ $user->email }}">
				</div>
			</div>


			<div class="box">
				<h3 class="title is-3">Ролі</h3>
					@foreach ($roles as $role)

						<input type="checkbox" name="roles[]" value="{{$role->id}}"
						@if ($user->roles->where('role_id', $role->id)->count())
							checked="checked"
						@endif
						>
						<label class="checkbox" for="roles">{{ $role->name }}</label>
						<br>
					@endforeach
			</div>



			<div class="field">
				<div class="control">
					<button type="submit" class="button is-link">
						Зберегти
					</button>
				</div>
			</div>



		</div>

	</form>
@endsection