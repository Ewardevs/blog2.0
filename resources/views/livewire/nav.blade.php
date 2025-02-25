<header class="border-b">
    <div class="container mx-auto px-4 py-8 flex flex-row justify-between">
        <div>

            <h1 class="text-4xl font-bold tracking-tight"><a href="{{route("pages.home")}}"> Blog</a></h1>
            <p class="mt-2 text-muted-foreground">Explora artículos sobre tecnología, cocina, viajes y más.</p>
        </div>
        <div>

            @if (Auth::user())
                @if (Auth::user()->role === "admin")
                    <a href="{{route("filament.admin.pages.dashboard")}}">Panel Administrativo</a>
                @endif
                <a href="{{route("pages.profile")}}" class="bg-slate-800 rounded-3xl w-auto h-auto px-3 py-1 text-center text-fuchsia-50">{{ Auth::user()->name }}</a>
                <a href="{{ route('logout') }}"> Logout</a>
            @else
                <a href="{{route("showLogin")}}">Login</a>
            @endif
        </div>
    </div>
</header>
