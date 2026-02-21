<section>
    <header>
        <h2 class="text-lg font-medium text-primary">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-white">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" class="text-primary" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text"
                class="mt-1 block w-full border-2 border-primary bg-gray-900" :value="old('name', $user->name)" required autofocus
                autocomplete="name" />
            <x-input-error class="mt-2 text-primary" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" class="text-primary" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email"
                class="mt-1 block w-full border-2 border-primary bg-gray-900" :value="old('email', $user->email)" required
                autocomplete="username" />
            <x-input-error class="mt-2 text-primary" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-primary">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification"
                            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re‑send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="col-span-6 sm:col-span-4">
            <label class="block text-sm font-medium text-primary">Profile Picture</label>
            <div class="mt-2 flex items-center gap-4">
                <img id="avatarPreview"
                    src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('assets/images/default-avatar.png') }}"
                    class="w-16 h-16 rounded-full object-cover border-2 border-primary" />

                <input type="file" name="avatar" id="avatarInput" accept="image/*"
                    class="text-sm text-gray-950
                    file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0
                    file:text-sm file:font-semibold
                    file:bg-[rgba(var(--primary-color),0.8)] file:text-white
                    hover:file:bg-[rgba(var(--primary-color),0.5)] hover:file:cursor-pointer" />

            </div>
        </div>



        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile‑updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-primary">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
    <div class="flex gap-2 px-3 py-3 border-t border-[#1F1F1F] mt-6">
        <select onchange="changeColor(this.value)"
            class="border border-gray-600 rounded px-2 py-1 bg-gray-900 text-white">
            <option value="" disabled selected>Select Theme</option>
            <option value="255, 221, 0" class=" bg-gray-900 text-white">🟡 Yellow Theme</option>
            <option value="34, 197, 94" class=" bg-gray-900 text-white">🟢 Green Theme</option>
            <option value="59, 130, 246" class=" bg-gray-900 text-white">🔵 Blue Theme</option>
            <option value="139, 92, 246" class=" bg-gray-900 text-white">🟣 Purple Theme</option>
            <option value="239, 80, 80" class=" bg-gray-900 text-white">🔴 Red Theme</option>
            <option value="255, 255, 255" class=" bg-gray-900 text-white">⚪ White Theme</option>
            <option value="78, 78, 78" class=" bg-gray-900 text-white">⚫ Gray Theme</option>
            <option value="236, 72, 153" class=" bg-gray-900 text-white">🌸 Pink Theme</option>
            <option value="249, 115, 22" class=" bg-gray-900 text-white">🟠 Orange Theme</option>
            <option value="120, 53, 15" class=" bg-gray-900 text-white">🟤 Brown Theme</option>
        </select>


    </div>

    <script src="{{ asset('assets/js/color.js') }}"></script>
</section>
