<x-client-layout>
    <div class=" text-gray-900 p-4">
        <div class="message flex flex-col">
            <span>
                Hello, {{ Auth::user()->name }}
            </span>
            <span class="text-xs text-gray-700">
                Welcome to your client dashboard
                <br>
                <span class="text-[10px]">
                    <a href="{{ route('client.projects.index') }}" class="text-blue-500">View Projects</a>
                </span>
            </span>
        </div>
        <!-- Page Modals -->

        <!-- Page Content -->
        <div class="py-4">
        </div>
    </div>
</x-client-layout>
