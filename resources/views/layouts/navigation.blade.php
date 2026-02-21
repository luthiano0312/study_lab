<nav x-data="{ open: false }" 
     class="fixed top-0 left-0 h-screen w-64 bg-[#070707] border-r border-[#1F1F1F] flex flex-col z-50 text-white">

    <div class="p-4 border-b border-[#1F1F1F]">
        <x-dropdown align="right" width="48">
            <x-slot name="trigger">
                <button class="w-full flex items-center gap-3 px-3 py-2 text-left hover:bg-[#121212] rounded-md transition">
                    <div class="relative w-10 h-10 rounded-full overflow-hidden border border-gray-700">
                        <img src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : asset('assets/images/default-avatar.png') }}" 
                             alt="User Avatar" 
                             class="w-full h-full object-cover">
                    </div>
                    <span class="text-sm font-semibold truncate">{{ Auth::user()->name }}</span>
                </button>
            </x-slot>

            <x-slot name="content">
                <x-dropdown-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-dropdown-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-dropdown-link :href="route('logout')" 
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-dropdown-link>
                </form>
            </x-slot>
        </x-dropdown>
    </div>

   
    <div class="flex-1 mt-4 px-2">
        <ul class="space-y-1">
            <li>
                <a href="{{ route('dashboard') }}" 
                   class="flex items-center gap-3 px-3 py-2 rounded-md transition {{ request()->routeIs('dashboard') ? 'bg-[#181818]' : 'hover:bg-[#121212]' }}">
                    <img src="{{ asset('assets/favicons/botao-de-inicio.png') }}" class="w-5 h-5 opacity-80" alt="">
                    <span class="text-sm font-medium">Home</span>
                </a>
            </li>

            <li>
                <a href="{{ route('games.index') }}" 
                   class="flex items-center gap-3 px-3 py-2 rounded-md transition {{ request()->routeIs('games.index') ? 'bg-[#181818]' : 'hover:bg-[#121212]' }}">
                    <img src="{{ asset('assets/favicons/controle.png') }}" class="w-5 h-5 opacity-80" alt="">
                    <span class="text-sm font-medium">Games</span>
                </a>
            </li>

            <li>
                <a href="{{ route('reminders.index') }}" 
                   class="flex items-center gap-3 px-3 py-2 rounded-md transition {{ request()->routeIs('reminders.index') ? 'bg-[#181818]' : 'hover:bg-[#121212]' }}">
                    <img src="{{ asset('assets/favicons/notificacao.png') }}" class="w-5 h-5 opacity-80" alt="">
                    <span class="text-sm font-medium">Reminders</span>
                </a>
            </li>

            <li>
                <a href="{{ route('friends.index') }}" 
                   class="flex items-center gap-3 px-3 py-2 rounded-md transition {{ request()->routeIs('friends.index') ? 'bg-[#181818]' : 'hover:bg-[#121212]' }}">
                    <img src="{{ asset('assets/favicons/amigos.png') }}" class="w-5 h-5 opacity-80" alt="">
                    <span class="text-sm font-medium">Friends</span>
                </a>
            </li>

            <li>
                <a href="{{ route('speedruns.index') }}" 
                   class="flex items-center gap-3 px-3 py-2 rounded-md transition {{ request()->routeIs('speedruns.index') ? 'bg-[#181818]' : 'hover:bg-[#121212]' }}">
                    <img src="{{ asset('assets/favicons/relogio.png') }}" class="w-5 h-5 opacity-80" alt="">
                    <span class="text-sm font-medium">Speedruns</span>
                </a>
            </li>

            <li>
                <a href="{{ route('wishlists.index') }}" 
                   class="flex items-center gap-3 px-3 py-2 rounded-md transition {{ request()->routeIs('wishlists.index') ? 'bg-[#181818]' : 'hover:bg-[#121212]' }}">
                    <img src="{{ asset('assets/favicons/lista-de-controle.png') }}" class="w-5 h-5 opacity-80" alt="">
                    <span class="text-sm font-medium">Wishlist</span>
                </a>
            </li>
        </ul>

        <div class="mt-6 border-t border-[#1F1F1F] pt-4">
            <div class="flex items-center justify-between px-3 mb-2 text-xs font-semibold text-gray-400 uppercase tracking-wide">
                <span>Library</span>
                <a href="{{ route('games.create') }}" 
                   class="text-primary hover:bg-primary-dark text-base leading-none rounded px-2 py-1">+</a>
            </div>

            
            <div class="space-y-2 px-1 overflow-y-auto max-h-[300px] pr-1">
                @forelse($games as $game)
                    <a href="{{ route('games.index') }}"
                       class="flex items-center gap-3 px-3 py-2 rounded-md hover:bg-[#121212] transition cursor-pointer">
                        <img src="{{ asset('storage/' . $game->imagem) }}" alt="{{ $game->titulo }}" class="w-6 h-6 object-cover rounded">
                        <span class="text-sm text-gray-200 truncate">{{ $game->titulo }}</span>
                    </a>
                @empty
                    <p class="text-xs text-gray-500 px-3">No Games</p>
                @endforelse
            </div>
        </div>
    </div>
</nav>
