@props([
    'title' => config('app.name', 'AdminKit'),
    'copyright' => '<a class="text-muted" href="https://adminkit.io/" target="_blank"><strong>AdminKit</strong></a>',
    'footerMenu' => [],
    'breadcrumbs' => [],
    'actions' => [],
    'homeUrl' => url('admin'),
    'logoutUrl' => url('logout'),
    'user',
    'userMenu' => [],
    'scripts' => null,
    'styles' => null,
    'adminSidebarCollapsed' => false,
    'appName' => config('app.name', 'AdminKit'),
    'menu' => [],
    'activeMenu' => null
])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    {{--
    <link rel="preconnect" href="https://fonts.gstatic.com">
    --}}
    <link rel="shortcut icon" href="{{ asset('assets/adminkit/img/icons/icon-48x48.png') }}" />
    <title>{{ $title }}</title>
    <link href="{{ asset('assets/adminkit/css/app.css') }}" rel="stylesheet">
    {{--
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    --}}
    {!! $styles !!}
    @stack('styles')
</head>
<body>
    <div class="wrapper">
        <nav id="sidebar" class="{{ $adminSidebarCollapsed 
            ? 'sidebar js-sidebar collapsed' 
            : 'sidebar js-sidebar' }}">
            <div class="sidebar-content js-simplebar">
                <a class="sidebar-brand" href="{{ $homeUrl }}">
                    <span class="align-middle">{{ $appName }}</span></a>
                <ul class="sidebar-nav">
                    @foreach($menu as $key => $values)
                        <li class="sidebar-header">
                            {{ __($key) }}
                        </li>
                        @foreach($values as $key => $value)
                            @php
                                $active = $activeMenu == $key;
                                $active = $value['active'] ?? $active;
                            @endphp
                            <li class="sidebar-item @if($active) active @endif">
                                <a class="sidebar-link" href="{{ $value['url'] }}">
                                    <x-admin::icon :icon="$value['icon'] ?? 'file'" />
                                    <span class="align-middle">{{ $value['label'] }}</span>
                                </a>
                            </li>
                        @endforeach
                    @endforeach
                </ul>
                @hasSection('sidebar')
                    <div class="sidebar-cta">
                        <div class="sidebar-cta-content">
                            @yield('sidebar')
                        </div>
                    </div>
                @endif
            </div>
        </nav>
        <div class="main">
            <nav class="navbar navbar-expand navbar-light navbar-bg">
                <a class="sidebar-toggle js-sidebar-toggle"><i class="hamburger align-self-center"></i></a>
                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav navbar-align">
                        <li class="nav-item dropdown">
                            <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" 
                                href="#" 
                                data-bs-toggle="dropdown">
                                <i class="align-middle" data-feather="settings"></i>
                            </a>
                            <a class="nav-link dropdown-toggle d-none d-sm-inline-block" 
                                href="#" 
                                data-bs-toggle="dropdown">
                                @if($user->avatarUrl)
                                    <img src="{{ $user->avatarUrl }}" 
                                        class="avatar img-fluid rounded me-1" 
                                        alt="" />
                                @endif
                                <span class="text-dark">{{ $user?->name }}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                @foreach($userMenu as $key => $value)
                                    @if($value === '---')
                                        <div class="dropdown-divider"></div>
                                    @else
                                        <a class="dropdown-item" href="{{ $value['url'] }}">
                                            <x-admin::icon :icon="$value['icon'] ?? null" /> {{ $value['label'] }}
                                        </a>
                                    @endif
                                @endforeach
                                @if($userMenu)
                                    <div class="dropdown-divider"></div>
                                @endif
                                <form action="{{ $logoutUrl }}" method="POST">
                                    @csrf
                                    <button class="dropdown-item" type="submit">{{ __('Log out') }}</button>
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <main class="content">
                <div class="container-fluid p-0">
                    @if($title || $actions)
                        <div class="row mb-2 mb-xl-3">
                            @if($title)
                                <div class="col-auto d-none d-sm-block">
                                    <h1 class="h3">{{ $title}}</h1>
                                </div>
                            @endif
                            @if($actions)
                                <div class="col-auto ms-auto text-end mt-n1">
                                    @foreach($actions as $action)
                                        <a href="{{ $action['url'] }}" 
                                            class="btn btn-{{ $action['button'] ?? 'primary' }}">
                                                <x-admin::icon :icon="$action['icon'] ?? null" />
                                            {{ $action['label'] }}</a>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endif
                    <x-admin::messages />
                    <div class="row">
                        <div class="col-12">
                            @hasSection('card')
                                @yield('card')
                            @else
                                <div class="card">
                                    @if($breadcrumbs)
                                        <div class="card-header" style="border-color: var(--bs-border-color); border-bottom-width: 1px;">
                                            @hasSection('filter')
                                                <div class="float-end">
                                                    @yield('filter')
                                                </div>
                                            @endif
                                            @if($breadcrumbs)
                                                <nav aria-label="breadcrumb" style="padding: .2rem; min-height: calc(1.525rem + 2px);">
                                                    <ol class="breadcrumb m-0">
                                                        @foreach($breadcrumbs as $key => $value)
                                                            @if(!is_int($key))
                                                                <li class="breadcrumb-item"><a href="{{ $value }}">{{ $key }}</a></li>
                                                            @else
                                                                <li class="breadcrumb-item active">{{ $value }}</li>
                                                            @endif
                                                        @endforeach
                                                    </ol>
                                                </nav>
                                            @endif
                                        </div>
                                    @endif
                                    <div class="card-body">@yield('content')</div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </main>
            @if($footerMenu || $copyright)
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row text-muted">
                            @if($copyright)
                                <div class="col-6 text-start">
                                    <p class="mb-0">
                                        {!! $copyright !!}
                                    </p>
                                </div>
                            @endif
                            @if($footerMenu)
                                <div class="col-6 text-end">
                                    <ul class="list-inline">
                                        @foreach($footerMenu as $key => $value)
                                            <li class="list-inline-item">
                                                <a class="text-muted" 
                                                    href="{{ $value }}" 
                                                    target="_blank">{{ $key }}</a>
                                            </li>                    
                                        @endforeach
                                    </ul>
                                </div>                            
                            @endif
                        </div>
                    </div>
                </footer>
            @endif
        </div>
    </div>
    <script src="{{ asset('assets/adminkit/js/app.js') }}"></script>
    {!! $scripts !!}
    @stack('scripts')
    <script type="text/javascript">     
        if (typeof $ !== 'undefined') {
            $(document).on("click", ".sidebar-toggle", function() {
                if ($("#sidebar").hasClass("collapsed")) {        
                    document.cookie = "admin-sidebar-collapsed=1; path=/";
                } else {
                    document.cookie = "admin-sidebar-collapsed=0; path=/";
                }
            });
        }
    </script>
</body>
</html>