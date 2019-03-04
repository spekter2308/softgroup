<nav class="navbar is-dark" role="navigation" aria-label="main navigation">
	<div class="navbar-brand">
		<a class="navbar-item" href="/posts" style="background: none" onmouseover="this.style.textDecoration ='none';">
			<h1 class="is-link">Головна</h1>
		</a>
	</div>

	{{--Ліва сторона меню--}}
	<div class="navbar-start d-inline-flex">
		<div class="navbar-item">
			<a href="" style="color: white;" onmouseover="this.style.textDecoration ='none';">
				Користувачі (для адміністратора)
			</a>
		</div>
	</div>

	{{--Права сторона меню--}}
	<div class="navbar-end">
		<!-- Authentication Links -->
		@guest
			<div class="navbar-item">
				<div class="buttons">
					<a class="button is-light" href="{{ route('login') }}">{{ __('Login') }}</a>
				@if (Route::has('register'))
					<a class="button is-light" href="{{ route('register') }}">{{ __('Register') }}</a>
				</div>
			</div>
			@endif
		@else
			<li class="nav-item dropdown">
				<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
					{{ Auth::user()->name }} <span class="caret"></span>
				</a>

				<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
					<a class="dropdown-item" href="{{ route('logout') }}"
					 	onclick="event.preventDefault();
							document.getElementById('logout-form').submit();">
							{{ __('Logout') }}
					</a>

					<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
						@csrf
					</form>
				</div>
			</li>
		@endguest
	</div>
</nav>
<br>