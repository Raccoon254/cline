<x-guest-layout>
    <div class="mb-4 text-sm text-gray-200">
        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <button class="btn ring-1 ring-offset-1 ring-gray-400 btn-secondary normal-case w-full mt-4 rounded-full btn-outline transition duration-300 ease-in-out">
                    {{ __('Resend Verification Email') }}
                </button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="ring-1 ring-inset btn btn-ghost rounded-full text-sm text-gray-400 hover:text-gray-200 normal-case focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ __('Log Out') }}
                <i class="fa-solid fa-arrow-right"></i>
            </button>
        </form>
    </div>
</x-guest-layout>
