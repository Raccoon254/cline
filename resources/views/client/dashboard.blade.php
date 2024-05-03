<x-client-layout>
    <div class=" text-gray-900 p-4">
        <div class="message flex flex-col">
            <span>
                Hello, {{ Auth::user()->name }}
            </span>
            <span class="text-xs text-gray-700">
                Welcome to your client dashboard
            </span>
        </div>

        <!-- Page Content -->
        <!-- All projects -->
        <div class="py-4">
            <livewire:client-projects />
        </div>
        <!-- All freelancers -->
        <div class="py-4">
            <h3 class="text-lg py-2 center font-semibold">All Freelancers</h3>
            <livewire:all-freelancers />
        </div>
    </div>
</x-client-layout>
