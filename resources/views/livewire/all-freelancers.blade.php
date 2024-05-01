<div class="clients p-2 rounded-lg h-[80vh] overflow-y-auto overflow-x-visible w-full">
    <div class="label flex flex-col center mb-4">
        <label class="w-full relative z-20">
            <input type="text" wire:model.live="search" class="w-full p-2 rounded-lg border border-gray-200"
                   placeholder="Type to search...">
            <i class="fa-solid fa-search absolute right-3 top-[50%] transform -translate-y-1/2 text-gray-400"></i>
        </label>
    </div>
    <!-- if we have no clients -->
    @if($freelancers->isEmpty())
        <div class="center w-full">
            <div class="text-gray-500 h-full mt-16 text-center">
                <i class="fa-solid text-3xl fa-user-slash"></i>
                <p class="text-lg">No users found</p>
                <span class="text-xs text-gray-500">Try typing a name or email</span>
            </div>
        </div>
    @else
        <div class="grid gap-4 grid-cols-1 p-2 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3">
            @foreach($freelancers as $freelancer)
                <a class="client-card bg-white rounded-xl"
                   data-tip="View {{ $freelancer->name }}"
                   href="{{ route('clients.show', $freelancer) }}">
                    <div class="bg-white rounded-xl p-4 relative shadow-md">
                        <div class="flex items-center">
                            <div class="w-full opacity-30 top-0 left-0 p-1 absolute">
                                <img
                                    class="h-32 rounded-lg w-full object-cover"
                                    src="https://cdn.pixabay.com/photo/2023/03/11/22/20/ai-art-7845451_1280.jpg"
                                    alt="{{ $freelancer->name }} profile picture"
                                >
                            </div>
                            <div class="absolute top-24 bg-white rounded-full left-4 p-1">
                                <img
                                    class="h-16 w-16 rounded-full object-cover"
                                    src="{{ $freelancer->profile_image }}"
                                    alt="{{ $freelancer->name }} profile picture"
                                >

                            </div>
                            <div class="z-30 mt-36 pt-2">
                                <!-- 20 chars max replace with ... -->
                                <h3 class="text-md font-semibold">{{ strlen($freelancer->name) > 18 ? substr($freelancer->name, 0, 18) . '...' : $freelancer->name }}</h3>
                            </div>
                        </div>
                        <div class="mt-4 flex justify-between items-center">
                            <!-- Messages .create route -->
                            <div onclick="window.location.href='{{ route('messages.create', $freelancer) }}'"
                                 class="btn font-normal custom-btn">
                                <i class="fa-solid fa-message"></i>
                                <span class="font-normal normal-case">
                                    Message
                                </span>
                            </div>

                            <!-- Mail, phone and message buttons -->
                            <div class="flex gap-2 justify-between">
                                <!-- Mail to -->
                                <div class="mail custom-btn"
                                     onclick="window.location.href='mailto:{{ $freelancer->email }}'">
                                    <i class="fa-solid fa-envelope"></i>
                                </div>
                                <!-- Phone -->
                                <div class="phone custom-btn"
                                     onclick="window.location.href='tel:{{ $freelancer->phone_number }}'">
                                    <i class="fa-solid fa-phone"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    @endif
    <div class="pagination mt-4">
        {{ $freelancers->links() }}
    </div>
</div>
