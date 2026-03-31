<input type="hidden" id="user_id" value="{{ Auth::user()->id }}">

{{-- Top Navigation Bar --}}
<nav class="fixed top-0 left-0 right-0 z-40 bg-white shadow-sm">
    <div class="max-w-screen-2xl mx-auto px-4 lg:px-8 flex items-center justify-between h-16">

        <div class="flex gap-4 justify-start items-center">
            {{-- Logo --}}
            <a href="{{ route('web.inicio') }}" class="shrink-0 w-32">
                <img src="{{ asset('images/logos/medpharma-logo.jpg') }}" alt="Medpharma" class="w-full max-w-32">
            </a>
    
            {{-- Separador --}}
            <div class="hidden lg:block w-px h-7 bg-dark mx-4"></div>

            {{-- Links de navegación (desktop) --}}
            <div class="hidden lg:flex items-center gap-6 xl:gap-8 flex-1">
                @php
                    $links = [
                        ['route' => 'web.inicio', 'label' => 'Inicio'],
                        ['route' => 'web.selecciones', 'label' => 'Selecciones'],
                        ['route' => 'web.grupos', 'label' => 'Grupos'],
                        ['route' => 'web.estadios', 'label' => 'Estadios'],
                        ['route' => 'web.quiniela', 'label' => 'Quiniela'],
                        ['route' => 'web.users.tabla-de-resultados', 'label' => 'Tabla de resultados'],
                        ['route' => 'web.tabla-de-premios', 'label' => 'Tabla de premios'],
                    ];
                @endphp
    
                @foreach ($links as $link)
                    <a href="{{ route($link['route']) }}"
                       class="relative text-sm font-bold whitespace-nowrap pb-1 transition-colors duration-150
                              {{ request()->routeIs($link['route']) ? 'text-dark border-b-3 px-2 border-complementary-secondary' : 'text-dark hover:text-complementary-secondary' }}">
                        {{ $link['label'] }}
                    </a>
                @endforeach
            </div>
        </div>


        {{-- Usuario dropdown --}}
        @php
            $user = Auth::user();
            $username = "{$user->nombres} {$user->apellidos}";
        @endphp
        <div class="hidden lg:block relative shrink-0 ml-4">
            <button id="user-dropdown-btn" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom-end" class="flex items-center gap-2 text-sm font-bold text-dark">
                {{ $username }}
                <span class="icon-[fluent--chevron-down-20-filled] w-4 h-4"></span>
            </button>
            <div id="user-dropdown" class="z-50 hidden bg-white rounded-lg shadow-lg border border-gray-200 w-44 transition-opacity! duration-150!">
                <ul class="py-1">
                    <li>
                        <form method="POST" action="{{ route('web.logout') }}">
                            @csrf
                            <button type="submit" class="w-full flex items-center gap-2 px-4 py-2 text-sm text-dark hover:bg-gray-100">
                                <span class="icon-[fluent--sign-out-20-filled] w-4 h-4"></span>
                                Cerrar sesión
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>

        {{-- Botón hamburguesa (móvil) --}}
        <button data-drawer-target="mobile-nav-drawer" data-drawer-show="mobile-nav-drawer" class="lg:hidden text-dark">
            <span class="icon-[fluent--navigation-20-filled] w-6 h-6"></span>
        </button>
    </div>
</nav>

{{-- Drawer de navegación móvil (Flowbite) --}}
<div id="mobile-nav-drawer" class="fixed -top-16 z-50 bg-white shadow-xl transition-transform -translate-y-full" tabindex="-1">
    <div class="flex items-center justify-between p-4 border-b border-gray-200">
        <img src="{{ asset('images/logos/medpharma-logo.png') }}" alt="Medpharma" class="h-8">
        <button data-drawer-hide="mobile-nav-drawer" class="text-dark">
            <span class="icon-[fluent--dismiss-20-filled] w-6 h-6"></span>
        </button>
    </div>

    <div class="flex flex-col gap-1 p-4">
        @php
            $mobileLinks = [
                ['route' => 'web.inicio', 'label' => 'Inicio', 'icon' => 'icon-[fluent--home-20-filled]'],
                ['route' => 'web.selecciones', 'label' => 'Selecciones', 'icon' => 'icon-[fluent--people-team-20-filled]'],
                ['route' => 'web.grupos', 'label' => 'Grupos', 'icon' => 'icon-[fluent--group-list-20-filled]'],
                ['route' => 'web.estadios', 'label' => 'Estadios', 'icon' => 'icon-[fluent--building-20-filled]'],
                ['route' => 'web.quiniela', 'label' => 'Quiniela', 'icon' => 'icon-[fluent--clipboard-text-edit-20-filled]'],
                ['route' => 'web.users.tabla-de-resultados', 'label' => 'Tabla de resultados', 'icon' => 'icon-[fluent--trophy-20-filled]'],
                ['route' => 'web.tabla-de-premios', 'label' => 'Tabla de premios', 'icon' => 'icon-[fluent--gift-20-filled]'],
            ];
        @endphp

        @foreach ($mobileLinks as $link)
            <a href="{{ route($link['route']) }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors duration-150
                      {{ request()->routeIs($link['route']) ? 'bg-primary text-white' : 'text-dark hover:bg-gray-100' }}">
                <span class="{{ $link['icon'] }} w-5 h-5"></span>
                {{ $link['label'] }}
            </a>
        @endforeach
    </div>

    <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-gray-200">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <span class="icon-[fluent--person-20-filled] w-6 h-6 text-dark"></span>
                <span class="text-sm font-bold text-dark">{{ $username }}</span>
            </div>
            <form method="POST" action="{{ route('web.logout') }}">
                @csrf
                <button type="submit" class="text-dark hover:text-red-600 transition-colors" title="Cerrar sesión">
                    <span class="icon-[fluent--sign-out-20-filled] w-5 h-5"></span>
                </button>
            </form>
        </div>
    </div>
</div>
