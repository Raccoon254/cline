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
        <div class="py-4">
            <div class="w-full h-full">
                <div class="bg-white w-full h-full shadow-md rounded-md p-4">
                    <div class="flex items justify-between">
                        <div class="flex flex-col">
                            <div>
                                <h3 class="text-lg font-normal">{{ $freelancer->name }}</h3>
                                <p class="text-xs text-gray-500">{{ $freelancer->email }}</p>
                            </div>
                            <div class="mt-2">
                                <!-- Joined on -->
                                <p class="text-xs text-gray-500">
                                    Joined on {{ $freelancer->created_at->format('M d, Y') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-client-layout>
