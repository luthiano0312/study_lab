<x-guest-layout>
    <div class="text-center mb-6">
        <x-application-logo-2 class="w-[80px] h-[80px] mx-auto mb-2" />
        <h2 class="text-2xl font-bold text-white">Create an account at Nitros</h2>
        <p class="text-gray-400 text-sm mt-1">
Join the community!</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        
        <div>
            <x-input-label class="text-white font-medium" for="name" :value="__('Your Full name')" />
            <x-text-input id="name"
                class="mt-1 w-full bg-transparent border border-gray-700 text-white rounded-md placeholder-gray-400 focus:border-cyan-400 focus:ring-0"
                type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-400" />
        </div>

        
        <div>
            <x-input-label class="text-white font-medium" for="nickname" :value="__('Nickname')" />
            <x-text-input id="nickname"
                class="mt-1 w-full bg-transparent border border-gray-700 text-white rounded-md placeholder-gray-400 focus:border-cyan-400 focus:ring-0"
                type="text" name="nickname" :value="old('nickname')" required autocomplete="nickname" />
            <x-input-error :messages="$errors->get('nickname')" class="mt-2 text-red-400" />
        </div>

        
        <div>
            <x-input-label class="text-white font-medium" for="email" :value="__('Email')" />
            <x-text-input id="email"
                class="mt-1 w-full bg-transparent border border-gray-700 text-white rounded-md placeholder-gray-400 focus:border-cyan-400 focus:ring-0"
                type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400" />
        </div>

        
        <div>
            <x-input-label class="text-white font-medium" for="bio" :value="__('Bio')" />
            <x-text-input id="bio"
                class="mt-1 w-full bg-transparent border border-gray-700 text-white rounded-md placeholder-gray-400 focus:border-cyan-400 focus:ring-0"
                type="text" name="bio" :value="old('bio')" required autocomplete="description" />
            <x-input-error :messages="$errors->get('bio')" class="mt-2 text-red-400" />
        </div>

        
        <div>
            <x-input-label class="text-white font-medium" for="password" :value="__('Password')" />
            <x-text-input id="password"
                class="mt-1 w-full bg-transparent border border-gray-700 text-white rounded-md placeholder-gray-400 focus:border-cyan-400 focus:ring-0"
                type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400" />
        </div>

        
        <div>
            <x-input-label class="text-white font-medium" for="password_confirmation" :value="__('Confirm password')" />
            <x-text-input id="password_confirmation"
                class="mt-1 w-full bg-transparent border border-gray-700 text-white rounded-md placeholder-gray-400 focus:border-cyan-400 focus:ring-0"
                type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-400" />
        </div>

        
        <div class="mt-6 text-center">
            <button type="submit"
                class="w-full py-3 bg-gradient-to-r from-violet-500 to-violet-700 hover:from-violet-500 hover:to-violet-800 text-white font-semibold rounded-md shadow-lg transition duration-300">
                Create account
            </button>

            <p class="text-gray-400 text-sm mt-4">
                You have an account?
                <a href="{{ route('login') }}" class="text-violet-400 hover:text-violet-300 font-medium">Login</a>
            </p>
        </div>
    </form>
</x-guest-layout>
