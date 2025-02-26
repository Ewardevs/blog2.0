<header class="border-b">
    <div class="max-w-7xl mx-auto px-4 py-4 sm:py-6 md:py-8 flex flex-col sm:flex-row justify-between items-center gap-4">
        <div class="text-center sm:text-left">
            <h1 class="text-3xl sm:text-4xl font-bold tracking-tight">
                <a href="{{route("pages.home")}}">Blog</a>
            </h1>
            <p class="mt-1 sm:mt-2 text-sm sm:text-base text-muted-foreground">
                Explora artículos sobre tecnología, cocina, viajes y más.
            </p>
        </div>
        <div class="relative">
            @if (Auth::user())
                <div x-data="{ open: false }" class="relative">
                    <!-- Botón del perfil que abre el menú -->
                    <button @click="open = !open" class="flex items-center gap-2 bg-slate-800 hover:bg-slate-700 rounded-3xl px-3 py-1 text-fuchsia-50 text-sm sm:text-base focus:outline-none">
                        <span>{{ Auth::user()->name }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <!-- Menú desplegable -->
                    <div x-show="open"
                         @click.away="open = false"
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="transform opacity-0 scale-95"
                         x-transition:enter-end="transform opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="transform opacity-100 scale-100"
                         x-transition:leave-end="transform opacity-0 scale-95"
                         class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                         style="display: none;">

                        <a href="{{route("pages.profile")}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Perfil
                        </a>

                        @if (Auth::user()->role === "admin")
                            <a href="{{route("filament.admin.pages.dashboard")}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                Panel Administrativo
                            </a>
                        @endif

                        <div class="border-t border-gray-200 my-1"></div>

                        <a href="{{ route('logout') }}" class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                            Cerrar sesión
                        </a>
                    </div>
                </div>
            @else
                <a href="{{route("showLogin")}}" class="inline-block bg-slate-800 rounded-3xl px-4 py-1.5 text-center text-fuchsia-50 text-sm sm:text-base hover:bg-slate-700">Login</a>
            @endif
        </div>
    </div>
</header>
