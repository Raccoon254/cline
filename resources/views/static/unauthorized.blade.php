<x-guest-layout>

        <div class="mb-4 text-sm text-gray-300">
            {{ __('You are not authorized to access this page.') }}
        </div>

        <div class="mt-4 flex items-center justify-between">
            <button>
                <a href="{{ route('dashboard') }}">Go Back</a>
            </button>
        </div>
</x-guest-layout>
