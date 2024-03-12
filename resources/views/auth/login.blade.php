<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')"/>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-4 mx-2 text-2xl font-semibold text-gray-200">
            {{ __('Cline Auth') }}
        </div>

        <!-- Email Address -->
        <div class="flex flex-col mt-4 gap-4 w-full sm:max-w-md">
            <x-text-input id="email" class="custom-input block mt-1 w-full" type="email"
                          name="email"
                          :value="old('email')" required
                          placeholder="Email e.g. name@cline.com"
                          autofocus autocomplete="username"/>
            <x-input-error :messages="$errors->get('email')" class="mt-2"/>

            <x-text-input id="password" class="custom-input block mt-1 w-full"
                          type="password"
                          name="password"
                            placeholder="Password e.g. px23ord"
                          required autocomplete="current-password"/>

            <x-input-error :messages="$errors->get('password')" class="mt-2"/>
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                       class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex flex-col justify-between">

            <div class="flex flex-col-reverse mb-4">

                <button class="btn ring-1 ring-offset-1 ring-gray-400 btn-secondary normal-case w-44 mt-4 rounded-full btn-outline">
                    {{ __('Login') }}
                    <i class="fa-solid fa-arrow-right"></i>
                </button>
            </div>

            <div class="text-actions flex mt-4">
                <a href="{{ route('register') }}" class="text-gray-400 hover:text-blue-400">
                    {{ __('Register') }}
                </a>
                <span class="text-gray-400 mx-2">|</span>
                <a href="{{ route('password.request') }}" class="text-gray-400 hover:text-blue-400">
                    {{ __('Forgot your password?') }}
                </a>
            </div>
        </div>

    </form>
</x-guest-layout>
