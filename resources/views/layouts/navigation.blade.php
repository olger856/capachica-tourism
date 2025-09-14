<nav x-data="{ sidebarOpen: false, userDropdownOpen: false }" class="flex h-screen bg-gray-900 text-gray-200">
    <!-- Sidebar -->
    <div :class="sidebarOpen ? 'w-72' : 'w-20'" class="flex flex-col transition-width duration-300 ease-in-out overflow-hidden bg-gray-900 border-r border-gray-800">
        <!-- Logo and toggle -->
        <div class="flex items-center justify-between p-4 border-b border-gray-800">
            <a href="{{ route('dashboard') }}" class="flex items-center space-x-2">
                <div class="bg-blue-600 rounded-md h-10 w-10 flex items-center justify-center font-bold text-white text-xl">A</div>
                <span x-show="sidebarOpen" class="text-lg font-semibold transition-opacity duration-300">AppTurismo</span>
            </a>
            <button @click="sidebarOpen = !sidebarOpen"
                class="p-2 rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-700">
                <svg x-show="sidebarOpen" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                </svg>
                <svg x-show="!sidebarOpen" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
        </div>

        <!-- Navigation Links -->
        <div class="flex-1 overflow-auto mt-4">
            <div class="px-4 text-xs uppercase tracking-wide text-gray-400" x-show="sidebarOpen" x-transition> Navegación </div>

            <a href="{{ route('dashboard') }}"
               class="flex items-center px-4 py-3 mt-2 mx-2 rounded-md hover:bg-gray-700 transition"
               :class="{'bg-blue-600 font-semibold': '{{ request()->routeIs('dashboard') ? 'true' : 'false' }}' == 'true'}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 flex-shrink-0" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="3" width="7" height="7" />
                    <rect x="14" y="3" width="7" height="7" />
                    <rect x="14" y="14" width="7" height="7" />
                    <rect x="3" y="14" width="7" height="7" />
                </svg>
                <span x-show="sidebarOpen" class="ml-3">Dashboard</span>
            </a>

            {{-- Solo usuarios con rol 'turista' --}}
            @if(Auth::check() && Auth::user()->role && Auth::user()->role->name === 'turista')
                <a href="{{ route('tourist.attractions') }}"
                   class="flex items-center px-4 py-3 mt-2 mx-2 rounded-md hover:bg-gray-700 transition"
                   :class="{'bg-blue-600 font-semibold': '{{ request()->routeIs('tourist.attractions') ? 'true' : 'false' }}' == 'true'}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 flex-shrink-0" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path d="M17 3a2.85 2.85 0 1 1 0 5.7"></path>
                        <path d="M10 3a2.83 2.83 0 1 1 0 5.7"></path>
                        <path d="M21 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <path d="M3 11v-1h18v1"></path>
                        <path d="M4 10V3h16v7"></path>
                    </svg>
                    <span x-show="sidebarOpen" class="ml-3">Turismo</span>
                </a>

                <!-- Enlace para recomendaciones -->
                <a href="{{ route('attractions.recommendations') }}"
                   class="flex items-center px-4 py-3 mt-2 mx-2 rounded-md hover:bg-gray-700 transition"
                   :class="{'bg-blue-600 font-semibold': '{{ request()->routeIs('attractions.recommendations') ? 'true' : 'false' }}' == 'true'}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 flex-shrink-0" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path d="M12 4v16m8-8H4" />
                    </svg>
                    <span x-show="sidebarOpen" class="ml-3">Recomendaciones</span>
                </a>

                <a href="{{ route('recommendations.index') }}"
                class="flex items-center px-4 py-3 mt-2 mx-2 rounded-md hover:bg-gray-700 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 flex-shrink-0" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path d="M12 4v16m8-8H4" />
                    </svg>
                    <span x-show="sidebarOpen" class="ml-3">Recomendaciones</span>
                </a>

            @endif
            {{-- Solo usuarios con rol 'admin' --}}
            @if(Auth::check() && Auth::user()->role && Auth::user()->role->name === 'admin')
                <a href="{{ route('tourist.attractions') }}"
                   class="flex items-center px-4 py-3 mt-2 mx-2 rounded-md hover:bg-gray-700 transition"
                   :class="{'bg-blue-600 font-semibold': '{{ request()->routeIs('tourist.attractions') ? 'true' : 'false' }}' == 'true'}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 flex-shrink-0" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path d="M17 3a2.85 2.85 0 1 1 0 5.7"></path>
                        <path d="M10 3a2.83 2.83 0 1 1 0 5.7"></path>
                        <path d="M21 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <path d="M3 11v-1h18v1"></path>
                        <path d="M4 10V3h16v7"></path>
                    </svg>
                    <span x-show="sidebarOpen" class="ml-3">Turismo</span>
                </a>
                <!-- Enlace a Estadísticas -->
                <a href="{{ route('admin.stats') }}"
                class="flex items-center px-4 py-3 mt-2 mx-2 rounded-md hover:bg-gray-700 transition"
                :class="{'bg-blue-600 font-semibold': '{{ request()->routeIs('admin.stats') ? 'true' : 'false' }}' == 'true'}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 flex-shrink-0" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path d="M11 17h2M12 3v14m-4-4h8" />
                    </svg>
                    <span x-show="sidebarOpen" class="ml-3">Estadísticas</span>
                </a>
                <a href="{{ route('admin.csv.upload.form') }}"
                class="flex items-center px-4 py-3 mt-2 mx-2 rounded-md hover:bg-gray-700 transition"
                :class="{'bg-blue-600 font-semibold': '{{ request()->routeIs('admin.csv-upload') ? 'true' : 'false' }}' == 'true'}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 flex-shrink-0" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path d="M4 4h16v16H4z" /> <!-- un ícono simple de caja, puedes cambiarlo -->
                        <path d="M8 8h8v8H8z" />
                    </svg>
                    <span x-show="sidebarOpen" class="ml-3">Carga CSV</span>
                </a>

                <a href="{{ route('analytics.index') }}"
                class="flex items-center px-4 py-3 mt-2 mx-2 rounded-md hover:bg-gray-700 transition"
                :class="{'bg-blue-600 font-semibold': '{{ request()->routeIs('analytics.index') ? 'true' : 'false' }}' == 'true'}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 flex-shrink-0" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path d="M3 3h18v18H3z" />
                        <path d="M9 17V9M15 17V5" />
                    </svg>
                    <span x-show="sidebarOpen" class="ml-3">Gráficas Predictivas</span>
                </a>

                <a href="{{ route('recommendations.charts') }}"
                class="flex items-center px-4 py-3 mt-2 mx-2 rounded-md hover:bg-gray-700 transition"
                :class="{'bg-blue-600 font-semibold': '{{ request()->routeIs('recommendations.charts') ? 'true' : 'false' }}' == 'true'}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 flex-shrink-0" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path d="M4 6h16M4 10h16M4 14h10" />
                    </svg>
                    <span x-show="sidebarOpen" class="ml-3">Gráficos de Recomendación</span>
                </a>
                <a href="{{ route('admin.powerbi') }}"
                class="flex items-center px-4 py-3 mt-2 mx-2 rounded-md hover:bg-gray-700 transition"
                :class="{'bg-blue-600 font-semibold': '{{ request()->routeIs('admin.powerbi') ? 'true' : 'false' }}' == 'true'}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 flex-shrink-0" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path d="M3 3h18v18H3z" />
                        <path d="M7 10h2v7H7zM11 6h2v11h-2zM15 13h2v4h-2z" />
                    </svg>
                    <span x-show="sidebarOpen" class="ml-3">Informe Power BI</span>
                </a>


            @endif
        </div>

        <!-- User dropdown -->
        <div class="border-t border-gray-800 p-4" @click.away="userDropdownOpen = false" x-data>
            <button @click="userDropdownOpen = !userDropdownOpen"
                class="flex items-center w-full rounded-md hover:bg-gray-700 focus:outline-none px-2 py-2">
                <div class="bg-blue-600 rounded-full h-10 w-10 flex items-center justify-center font-bold text-white flex-shrink-0">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div x-show="sidebarOpen" class="ml-3 flex flex-col text-left overflow-hidden" x-transition>
                    <span class="font-semibold truncate">{{ Auth::user()->name }}</span>
                    <span class="text-xs text-gray-400 truncate">{{ Auth::user()->email }}</span>
                </div>
                <svg x-show="sidebarOpen" xmlns="http://www.w3.org/2000/svg" class="ml-auto h-5 w-5 flex-shrink-0" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" x-transition>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 9l6 6 6-6" />
                </svg>
            </button>

            <!-- Dropdown menu -->
            <div x-show="userDropdownOpen" x-transition class="mt-2 bg-gray-800 rounded-md shadow-lg py-1">
                <a href="{{ route('profile.edit') }}"
                   class="block px-4 py-2 text-sm hover:bg-gray-700 transition">{{ __('Profile') }}</a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full text-left px-4 py-2 text-sm hover:bg-gray-700 transition">
                        {{ __('Log Out') }}
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <div class="flex-1 bg-gray-100 p-6 overflow-auto">
        {{ $slot ?? '' }}
    </div>
</nav>
