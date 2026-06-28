<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', __('messages.app_name'))</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        crossorigin="anonymous" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />
    <style>
        body {
            background-color: #f4f6f9;
        }

        .navbar-brand {
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .nav-link.active {
            font-weight: 600;
        }

        main {
            min-height: 80vh;
        }
    </style>
</head>

<body>
    @if (!request()->routeIs('login') && !request()->routeIs('register'))
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <i class="bi bi-truck me-2"></i>{{ __('messages.app_name') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navMenu">
                    <div class="navbar-nav ms-auto">
                        @auth
                            <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                                href="{{ route('dashboard') }}">
                                <i class="bi bi-speedometer2 me-1"></i>{{ __('messages.dashboard') }}
                            </a>
                            <a class="nav-link {{ request()->routeIs('deliveries.*') ? 'active' : '' }}"
                                href="{{ route('deliveries.index') }}">
                                <i class="bi bi-truck me-1"></i>{{ __('messages.deliveries') }}
                            </a>
                            <div class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                    <i class="bi bi-person-circle me-1"></i>{{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><span class="dropdown-item-text text-muted">{{ __('messages.role') }}:
                                            {{ Auth::user()->role }}</span></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="dropdown-item">
                                                <i class="bi bi-box-arrow-right me-1"></i>{{ __('messages.logout') }}
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        @else
                            <a class="nav-link" href="{{ route('login') }}">
                                <i class="bi bi-box-arrow-in-right me-1"></i>{{ __('messages.login') }}
                            </a>
                            <a class="nav-link" href="{{ route('register') }}">
                                <i class="bi bi-person-plus me-1"></i>{{ __('messages.register') }}
                            </a>
                        @endauth
                    </div>
                    <div class="navbar-nav ms-2">
                        <a class="nav-link"
                            href="{{ route('lang.switch', ['locale' => App::getLocale() === 'en' ? 'km' : 'en']) }}">
                            <i
                                class="bi bi-globe me-1"></i>{{ App::getLocale() === 'en' ? __('messages.khmer') : __('messages.english') }}
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    @endif

    <main class="container py-4 @yield('main-class')">
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
</body>

</html>