<x-guest-layout>
    <div class="text-center mb-6">
        <x-application-logo-2 class="w-[120px] h-[120px] mx-auto " />
        <h2 class="text-2xl font-bold text-white">Enter the Nitros</h2>
        <p class="text-gray-400 text-sm mt-1">Welcome back!</p>
    </div>

    <x-auth-session-status class="mb-4 text-center text-green-400" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        
        <div>
            <x-input-label class="text-white font-medium" for="email" :value="__('Email')" />
            <x-text-input id="email"
                class="mt-1 w-full bg-transparent border border-white text-white rounded-md placeholder-gray-400 focus:border-cyan-400 focus:ring-0 transition duration-200"
                type="email"
                name="email"
                :value="old('email')"
                required
                autofocus
                autocomplete="username"
                 />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400" />
        </div>

        
        <div>
            <x-input-label class="text-white font-medium" for="password" :value="__('Senha')" />
            <x-text-input id="password"
                class="mt-1 w-full bg-transparent border border-white text-white rounded-md placeholder-gray-400 focus:border-cyan-400 focus:ring-0 transition duration-200"
                type="password"
                name="password"
                required
                autocomplete="current-password"
                 />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400" />
        </div>

        
        <div class="flex items-center justify-between mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded border-white bg-transparent text-cyan-400 focus:ring-cyan-400 focus:ring-offset-0 focus:ring-1"
                    name="remember">
                <span class="ms-2 text-sm text-gray-400">Remember me</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-violet-400 hover:text-violet-300 transition"
                   href="{{ route('password.request') }}">
                    Forgot your password?
                </a>
            @endif
        </div>

        
        <div class="mt-6">
            <button type="submit"
                class="w-full py-3 bg-gradient-to-r from-violet-500 to-violet-700 hover:from-violet-500 hover:to-violet-800 text-white font-semibold rounded-md shadow-lg transition duration-300">
                Login
            </button>
        </div>

        
        <div class="text-center mt-4 text-gray-400 text-sm">
            Don't have an account?
            <a href="{{ route('register') }}" class="text-violet-400 hover:text-violet-300 font-medium">  
            Create account
            </a>
        </div>
    </form>
</x-guest-layout>
