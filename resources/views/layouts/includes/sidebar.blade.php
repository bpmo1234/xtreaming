<div class="app-aside nav-aside" id="aside">
    <button class="modal-close d-md-none d-block" data-dismiss="modal">
        <svg class="icon">
            <use xlink:href="{{ asset('images/sprite.svg') }}#close" />
        </svg>
    </button>
    <ul class="nav mb-3 nav-user d-md-none d-block">
        @auth
            <li class="nav-item dropdown">
                <a class="nav-link nav-profile dropdown-toggle" href="#" role="button" id="dropdown-profile-mobile"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-labelledby="Profile Mobile">
                    <div class="avatar avatar-sm" style="">{{ authNameFirstLetter() }}</div>
                    <div class="profile-text">
                        <div class="profile-head">
                            Hello,</div>
                        <div class="text-nowrap">{{ $u->name }}</div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-profile" aria-labelledby="Dropdown Profile Mobile">
                    <a class="dropdown-item" href="{{ route('filament.pages.dashboard') }}">
                        Admin panel</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('profile') }}">
                        Profile</a>
                    <a class="dropdown-item d-flex" href="{{ route('profile') }}#collections">
                        Collections</a>
                    <a class="dropdown-item" href="{{ route('notifications') }}">
                        Notifications</a>
                    <a class="dropdown-item" href="{{ route('settings') }}">
                        Settings</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('logout') }}">
                        Logout
                    </a>
                </div>
            </li>
        @else
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}" aria-label="Register">
                    Register </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}" aria-label="Login">
                    Login </a>
            </li>
        @endauth
        </li>
    </ul>
    <ul class="nav">
        <li class="active">
            <a href="{{ route('index') }}">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('images/sprite.svg') }}#house" />
                </svg>
                Home</a>
        </li>
        <li>
            <a href="https://demo.codelug.com/wovie/discovery">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('images/sprite.svg') }}#discovery" />
                </svg>
                Discovery</a>
        </li>
        <li>
            <a href="https://demo.codelug.com/wovie/trends">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('images/sprite.svg') }}#trend" />
                </svg>
                Trends</a>
        </li>
        <li>
            <a href="https://demo.codelug.com/wovie/movies">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('images/sprite.svg') }}#film" />
                </svg>
                Movies</a>
        </li>
        <li>
            <a href="https://demo.codelug.com/wovie/series">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('images/sprite.svg') }}#tv" />
                </svg>
                TV Shows</a>
        </li>
        <li>
            <a href="{{ route('persons') }}">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('images/sprite.svg') }}#actors" />
                </svg>
                Actors </a>
        </li>
        <li class="nav-header">
            Discovery </li>
        <li>
            <a href="{{ route('genres') }}">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('images/sprite.svg') }}#categories" />
                </svg>
                Categories</a>
        </li>
        <li>
            <a href="https://demo.codelug.com/wovie/discussions">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('images/sprite.svg') }}#discussion" />
                </svg>
                Discussions</a>
        </li>
        <li>
            <a href="{{ route('collections') }}">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('images/sprite.svg') }}#collections" />
                </svg>
                Collections</a>
        </li>
    </ul>
    <ul class="nav-trend d-none d-lg-block">
        <li class="nav-header">Top Trends</li>
        <li>
            <a href="https://demo.codelug.com/wovie/serie/chilling-adventures-of-sabrina-22" class="nav-content">
                <div>Chilling Adventures of Sabrina</div>
                <div class="view">
                    <svg>
                        <use xlink:href="{{ asset('images/sprite.svg') }}#trend" />
                    </svg>
                    <div>2414 views</div>
                </div>
            </a>
        </li>
        <li>
            <a href="https://demo.codelug.com/wovie/movie/interstellar-1" class="nav-content">
                <div>Interstellar</div>
                <div class="view">
                    <svg>
                        <use xlink:href="{{ asset('images/sprite.svg') }}#trend" />
                    </svg>
                    <div>1567 views</div>
                </div>
            </a>
        </li>
        <li>
            <a href="https://demo.codelug.com/wovie/movie/shutter-island-9" class="nav-content">
                <div>Shutter Island</div>
                <div class="view">
                    <svg>
                        <use xlink:href="{{ asset('images/sprite.svg') }}#trend" />
                    </svg>
                    <div>1559 views</div>
                </div>
            </a>
        </li>
        <li>
            <a href="https://demo.codelug.com/wovie/movie/mad-max-fury-road-7" class="nav-content">
                <div>Mad Max: Fury Road</div>
                <div class="view">
                    <svg>
                        <use xlink:href="{{ asset('images/sprite.svg') }}#trend" />
                    </svg>
                    <div>1486 views</div>
                </div>
            </a>
        </li>
        <li>
            <a href="https://demo.codelug.com/wovie/movie/iron-man-4" class="nav-content">
                <div>Iron Man</div>
                <div class="view">
                    <svg>
                        <use xlink:href="{{ asset('images/sprite.svg') }}#trend" />
                    </svg>
                    <div>1136 views</div>
                </div>
            </a>
        </li>
        <li>
            <a href="https://demo.codelug.com/wovie/movie/django-unchained-6" class="nav-content">
                <div>Django Unchained</div>
                <div class="view">
                    <svg>
                        <use xlink:href="{{ asset('images/sprite.svg') }}#trend" />
                    </svg>
                    <div>1082 views</div>
                </div>
            </a>
        </li>
        <li>
            <a href="https://demo.codelug.com/wovie/movie/harry-potter-and-the-philosophers-stone-3"
                class="nav-content">
                <div>Harry Potter and the Philosopher's Stone</div>
                <div class="view">
                    <svg>
                        <use xlink:href="{{ asset('images/sprite.svg') }}#trend" />
                    </svg>
                    <div>905 views</div>
                </div>
            </a>
        </li>
        <li>
            <a href="https://demo.codelug.com/wovie/movie/avengers-age-of-ultron-8" class="nav-content">
                <div>Avengers: Age of Ultron</div>
                <div class="view">
                    <svg>
                        <use xlink:href="{{ asset('images/sprite.svg') }}#trend" />
                    </svg>
                    <div>710 views</div>
                </div>
            </a>
        </li>
        <li>
            <a href="https://demo.codelug.com/wovie/movie/the-shawshank-redemption-5" class="nav-content">
                <div>The Shawshank Redemption</div>
                <div class="view">
                    <svg>
                        <use xlink:href="{{ asset('images/sprite.svg') }}#trend" />
                    </svg>
                    <div>635 views</div>
                </div>
            </a>
        </li>
        <li>
            <a href="https://demo.codelug.com/wovie/serie/the-act-21" class="nav-content">
                <div>The Act</div>
                <div class="view">
                    <svg>
                        <use xlink:href="{{ asset('images/sprite.svg') }}#trend" />
                    </svg>
                    <div>442 views</div>
                </div>
            </a>
        </li>
    </ul>
</div>
