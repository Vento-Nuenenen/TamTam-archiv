<nav class="navbar navbar-expand-md navbar-light navbar-laravel">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <ul class="collapse navbar-collapse" id="navbarSupportedContent">
            @if(!Auth::guest())
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('overwatch/')}}" href="{{ url('/overwatch') }}">
                            Overwatch
                        </a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Konfiguration
                        </a>

                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item {{ Request::is('users/')}}" href="{{ url('/users') }}">
                                Benutzer
                            </a>
                            <li><hr class="dropdown-divider" /></li>
                            <a class="dropdown-item {{ Request::is('groups/')}}" href="{{ url('/groups') }}">
                                Gruppen
                            </a>
                            <li><hr class="dropdown-divider" /></li>
                            <a class="dropdown-item {{ Request::is('participations/')}}" href="{{ url('/participations') }}">
                                Teilnehmer
                            </a>
                            <a class="dropdown-item {{ Request::is('passed/')}}" href="{{ url('/passed') }}">
                                Bestanden
                            </a>
                            <li><hr class="dropdown-divider" /></li>
                            <a class="dropdown-item {{ Request::is('numbers/')}}" href="{{ url('/numbers') }}">
                                Notfallnummern
                            </a>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Punkte
                        </a>

                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item {{ Request::is('points/')}}" href="{{ url('/points') }}">
                                Punkte übersicht
                            </a>
                            <li><hr class="dropdown-divider" /></li>
                            <a class="dropdown-item {{ Request::is('transactions/')}}" href="{{ url('/transactions') }}">
                                Punkte transaktionen
                            </a>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Druckerei
                        </a>

                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item {{ Request::is('id/')}}" href="{{ url('/id') }}">
                                ID-Karten
                            </a>
                            <li><hr class="dropdown-divider" /></li>
                            <a class="dropdown-item {{ Request::is('gratulation/')}}" href="{{ url('/gratulation') }}">
                                Gratulationen
                            </a>
                        </ul>
                    </li>
                </ul>
            @endif

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
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
