<nav class="navbar navbar-expand-md navbar-light navbar-laravel">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
            <span class="sr-only">{!! trans('titles.toggleNav') !!}</span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        @if(!Auth::guest())
            <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('success/')}}" href="{{ url('/success') }}">
                            Success
                        </a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Konfig
                        </a>

                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item {{ Request::is('participations/')}}" href="{{ url('/participations') }}">
                                Teilnehmer
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item {{ Request::is('users/')}}" href="{{ url('/users') }}">
                                Benutzer
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item {{ Request::is('groups/')}}" href="{{ url('/groups') }}">
                                Gruppen
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item {{ Request::is('fields/')}}" href="{{ url('/fields') }}">
                                Posten
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item {{ Request::is('points/')}}" href="{{ url('/points') }}">
                                Punkte
                            </a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Info
                        </a>

                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item {{ Request::is('gratulation/')}}" href="{{ url('/gratulation') }}">
                                Gratulation
                            </a>
                        </div>
                    </li>
                </ul>
        @endif

        <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->scout_name }} <span class="caret"></span>
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
            </ul>
        </div>
    </div>
</nav>
