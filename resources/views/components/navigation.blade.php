@php
    $user = Auth::user();
    $username = "{$user->nombres} {$user->apellidos}";
    $navLinks = [
        [
            'route' => 'web.inicio',
            'label' => 'Inicio',
            'icon'  => 'icon-[fluent--home-16-filled]',
        ],
        [
            'route' => 'web.selecciones',
            'label' => 'Selecciones',
            'icon'  => 'icon-[fluent--people-team-20-filled]',
        ],
        [
            'route' => 'web.grupos',
            'label' => 'Grupos',
            'icon'  => 'icon-[fluent--contact-card-group-16-filled]',
        ],
        [
            'route' => 'web.estadios',
            'label' => 'Estadios',
            'icon'  => 'icon-[fluent--seat-multiple-stadium-16-filled]',
        ],
        [
            'route' => 'web.quiniela',
            'label' => 'Calendario y Quiniela',
            'icon'  => 'icon-[fluent--calendar-12-filled]',
        ],
        [
            'route' => 'web.users.tabla-de-resultados',
            'label' => 'Tabla de resultados',
            'icon'  => 'icon-[fluent--medal-16-filled]',
        ],
        [
            'route' => 'web.tabla-de-premios',
            'label' => 'Premios',
            'icon'  => 'icon-[fluent--gift-card-multiple-20-filled]',
        ],
    ];
@endphp

<input type="hidden" id="user_id" value="{{ $user->id }}">

{{-- Top Navigation Bar --}}
<nav class="fixed top-0 left-0 right-0 z-50 bg-white shadow-sm">
    <div class="max-w-screen-2xl mx-auto px-4 lg:px-8 flex items-center justify-between h-16">

        <div class="flex gap-4 justify-start items-center">
            {{-- Logo --}}
            <a href="{{ route('web.inicio') }}" class="shrink-0 w-32">
                <img src="{{ asset('images/logos/medpharma-logo.jpg') }}" alt="Medpharma" class="w-full max-w-32">
            </a>

            {{-- Separador --}}
            <div class="hidden lg:block w-px h-7 bg-dark mx-4"></div>

            {{-- Links de navegación (desktop) --}}
            <div class="hidden lg:flex items-center gap-6 xl:gap-8 flex-1 font-sans">
                @foreach ($navLinks as $link)
                    <a href="{{ route($link['route']) }}"
                       class="relative text-xs min-[1140px]:text-sm font-bold whitespace-nowrap transition-colors duration-150
                              {{ request()->routeIs($link['route']) ? 'text-dark border-b-3 px-2 border-complementary-secondary pb-1' : 'text-dark hover:text-complementary-secondary' }}">
                        {{ $link['label'] }}
                    </a>
                @endforeach
            </div>
        </div>


        {{-- Usuario dropdown --}}
        <div class="hidden lg:block relative shrink-0 ml-4">
            <button
                id="user-dropdown-btn"
                data-dropdown-toggle="user-dropdown"
                data-dropdown-placement="bottom-end"
                class="flex items-center gap-1.5 text-xs min-[1140px]:text-sm font-bold text-dark lg:max-w-[22ch] xl:max-w-[25ch] 2xl:max-w-[40ch] hover:text-complementary-secondary"
            >
                {{-- <span class="icon-[fluent--person-12-filled] w-4 h-4 xl:w-5 xl:h-5 shrink-0"></span> --}}
                <span class="truncate">{{ $username }}</span>
                <span class="icon-[fluent--chevron-down-20-filled] w-4 h-4 shrink-0"></span>
            </button>
            <div id="user-dropdown" class="z-50 hidden bg-white rounded-lg shadow-lg border border-gray-200 w-44 transition-opacity! duration-150!">
                <ul class="py-1">
                    @if ($user->hasRole('admin'))
                        <li>
                            <a href="{{ route('web.admin.reports.users.index') }}" class="w-full flex items-center gap-2 px-4 py-2 text-sm text-dark hover:bg-gray-100">
                                <span class="icon-[fluent--person-shield-16-filled] w-5 h-5"></span>
                                Admin
                            </a>
                        </li>
                    @endif
                    <li>
                        <form method="POST" action="{{ route('web.logout') }}">
                            @csrf
                            <button type="submit" class="w-full flex items-center gap-2 px-4 py-2 text-sm text-dark hover:bg-gray-100">
                                <span class="icon-[fluent--arrow-exit-16-filled] w-5 h-5    "></span>
                                Cerrar sesión
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>

        {{-- Botón hamburguesa (móvil) --}}
        <button data-drawer-target="mobile-nav-drawer" data-drawer-toggle="mobile-nav-drawer" data-drawer-placement="top" class="lg:hidden text-dark">
            <span class="icon-[fluent--navigation-20-filled] w-6 h-6"></span>
        </button>
    </div>
</nav>

{{-- Drawer de navegación móvil (Flowbite) --}}
<div id="mobile-nav-drawer" class="lg:hidden fixed top-16 left-0 right-0 z-40 bg-white shadow-xl transition-transform -translate-y-full pt-6 p-4" tabindex="-1">
    <p class="flex items-start gap-3 text-sm text-dark mb-4">
        <span class="icon-[fluent--person-12-filled] w-10 h-10"></span>
        <span class="uppercase text-2xl font-brandan">{{ $username }}</span>
    </p>

    <div class="flex flex-col gap-1 font-sans">
        @foreach ($navLinks as $link)
            <a href="{{ route($link['route']) }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors duration-150
                      {{ request()->routeIs($link['route']) ? 'bg-secondary text-white' : 'text-dark hover:bg-gray-100' }}">
                <span class="{{ $link['icon'] }} w-6 h-6"></span>
                {{ $link['label'] }}
            </a>
        @endforeach
            @if ($user->hasRole('admin'))
                <a href="{{ route('web.admin.reports.users.index') }}" class="w-full flex items-center gap-2 px-4 py-2 text-sm text-dark hover:bg-gray-100">
                    <span class="icon-[fluent--person-shield-16-filled] w-5 h-5"></span>
                    Admin
                </a>
            @endif
            <form method="POST" action="{{ route('web.logout') }}" class="w-full">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors duration-150 hover:bg-gray-100">
                    <span class="icon-[fluent--arrow-exit-16-filled] w-6 h-6"></span>
                    Cerrar sesión
                </button>
            </form>
    </div>
</div>
