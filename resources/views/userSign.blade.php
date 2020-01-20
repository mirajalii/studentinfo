<div class="inner-log-btn">
    @guest
            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
        @if (Route::has('register'))
            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
        @endif
        @else
            <span class="btn btn-success">{{ Auth::user()->name }}</span>
            <a class="btn btn-warning" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
            </form>
    @endguest
</div>
<!-- Authentication Links -->
        