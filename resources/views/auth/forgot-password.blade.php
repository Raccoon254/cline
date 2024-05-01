<x-guest-layout>
    <div class="mb-4 text-sm text-gray-200">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form class="w-full max-w-md" method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-text-input id="email" class="block custom-input mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus
            placeholder="Enter your email"
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="center mt-4">
            <button class="btn btn-ghost border border-primary ring-c w-full rounded-full normal-case">
                {{ __('Email Me') }}
            </button>
        </div>
    </form>
</x-guest-layout>
