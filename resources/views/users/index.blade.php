@extends('layouts.app')

@section('content')

	@include('layouts.success')

	<div class="content">
		<table>
			<thead>
			<tr class="">
				<th class="has-text-centered">Ім'я</th>
				<th class="has-text-centered">E-mail</th>
				<th class="has-text-centered">Ролі</th>
				<th class="has-text-centered">Дія</th>
			</tr>
			</thead>
			<tbody>
			<tr>
			@foreach ($users as $user)
				@php
					/** @var \App\User $user*/
				@endphp
					<td class="has-text-centered">{{ $user->name }}</td>
					<td class="has-text-centered">{{ $user->email }}</td>
					<td class="has-text-centered">
						@foreach ($user->roles as $role)
							{{ $loop->first ? '' : ', ' }}
							{{ $role->name }}
						@endforeach
					</td>
					<td class="has-text-centered">
						<form method="POST" action="{{route('users.destroy', $user->id) }}">
							@csrf
							@method('DELETE')
							<a class="btn btn-primary" href="{{route('users.edit', $user->id) }}">Редагувати</a>
							<button type="submit" class="button is-danger">Видалити</button>
						</form>
					</td>
				</tr>

				@endforeach
				</tr>
			</tbody>
		</table>


	</div>
@endsection