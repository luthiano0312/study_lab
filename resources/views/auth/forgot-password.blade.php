<x-guest-layout>
    <div class="text-center mb-6">
        <x-application-logo-2 class="w-[120px] h-[120px] mx-auto mb-4" />
        <h2 class="text-2xl font-bold text-white">Recover password</h2>
        <p class="text-gray-400 text-sm mt-1">
            Forgot your password? No problem — enter your email below and we'll send you a link to reset it.
        </p>
    </div>

    
    <x-auth-session-status class="mb-4 text-center text-green-400" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
        @csrf

        
        <div>
            <x-input-label class="text-white font-medium" for="email" :value="__('Email')" />
            <x-text-input id="email"
                class="mt-1 w-full bg-transparent border border-gray-700 text-white rounded-md placeholder-gray-400 focus:border-cyan-400 focus:ring-0 transition duration-200"
                type="email"
                name="email"
                :value="old('email')"
                required
                autofocus
                />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400" />
        </div>

        
        <div class="mt-6">
            <button type="submit"
                class="w-full py-3 bg-gradient-to-r from-violet-400 to-violet-500 hover:from-violet-500 hover:to-violet-600 text-white font-semibold rounded-md shadow-lg transition duration-300">
                Send reset link
            </button>
        </div>

        
        <div class="text-center mt-4 text-gray-400 text-sm">
            Remember your password?
            <a href="{{ route('login') }}" class="text-violet-400 hover:text-violet-300 font-medium">
                Login
            </a>
        </div>
    </form>
</x-guest-layout>
