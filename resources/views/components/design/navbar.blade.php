<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a
                        class="nav-link @if(request()->route('/')) active @endif"
                        href="/">
                        {{ __('Главная') }}
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a
                        class="nav-link dropdown-toggle @if(request()->routeIs('news.* || categories.*')) active @endif"
                        data-bs-toggle="dropdown"
                        href="#" role="button"
                        aria-expanded="false">
                        {{ __('Новости') }}
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/categories">{{ __('Категории новостей') }}</a></li>
                        <li><a class="dropdown-item" href="{{route('parse.valutas')}}">{{ __('Курсы валют') }}</a></li>
                        <li><a class="dropdown-item" href="/news/create">{{ __('Добавить новость') }}</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a
                        class="nav-link dropdown-toggle @if(request()->routeIs('feedback.*')) active @endif"
                        data-bs-toggle="dropdown"
                        href="#" role="button"
                        aria-expanded="false">
                        {{ __('Отзывы') }}
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/feedback/">{{ __('Все отзывы') }}</a></li>
                        <li><a class="dropdown-item" href="/feedback/input">{{ __('Добавить отзыв / комментарий') }}</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a
                        class="nav-link dropdown-toggle @if(request()->routeIs('order')) active @endif"
                        data-bs-toggle="dropdown"
                        href="#"
                        role="button"
                        aria-expanded="false">
                        {{ __('Заказать') }}
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/order">{{ __('Все заказы') }}</a></li>
                        <li><a class="dropdown-item" href="/order/input">{{ __('Добавить заказ') }}</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <ul class="d-flex">

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Вход') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Регистрация') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a
                            class="nav-link dropdown-toggle"
                            data-bs-toggle="dropdown"
                            href="#"
                            role="button"
                            aria-expanded="false"
                        >
                            {{ Auth::user()->name }}
                        </a>

                        <ul class="dropdown-menu">
                            @if(Auth::user()->role_id === 1)
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.index') }}">
                                    {{ __('Админка') }}
                                </a>
                            </li>
                            @endif
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
