<div class="clients p-2 rounded-lg overflow-x-visible w-full">
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
                <div class="client-card bg-white rounded-xl" data-tip="View {{ $freelancer->name }}">
                    <div class="bg-white rounded-xl p-4 relative shadow-md">
                        <!--Share button to whatsapp, facebook, twitter and linkedin-->
                        <div class="absolute z-50 top-0 right-0 p-2">
                            <div class="dropdown rounded-t-md hover:bg-white bg:bg-opacity-50 dropdown-hover">
                                <button tabindex="0" role="button" class="btn m-1 btn-square btn-ghost btn-sm rounded-sm">
                                    <i class="fa-solid fa-share-nodes"></i>
                                </button>
                                <div class="dropdown-content rounded-b-md p-1 flex flex-col center bg-white backdrop-blur-[1px]">
                                    <div onclick="window.location.href='https://wa.me/?text={{ $freelancer->name }}\'s profile on our platform {{ route('clients.show', $freelancer) }}"
                                         class="btn btn-ghost btn-sm btn-square rounded-sm">
                                        <i class="fa-brands fa-whatsapp"></i>
                                    </div>
                                    <div onclick="window.location.href='https://www.facebook.com/sharer/sharer.php?u={{ route('clients.show', $freelancer) }}'"
                                         class="btn btn-ghost btn-sm btn-square rounded-sm">
                                        <i class="fa-brands fa-facebook"></i>
                                    </div>
                                    <div onclick="window.location.href='https://twitter.com/intent/tweet?url={{ route('clients.show', $freelancer) }}'"
                                         class="btn btn-ghost btn-sm btn-square rounded-sm">
                                        <i class="fa-brands fa-twitter"></i>
                                    </div>
                                    <div onclick="window.location.href='https://www.linkedin.com/shareArticle?mini=true&url={{ route('clients.show', $freelancer) }}'"
                                         class="btn btn-ghost btn-sm btn-square rounded-sm">
                                        <i class="fa-brands fa-linkedin"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <div class="w-full opacity-30 top-0 left-0 p-1 absolute">
                                <img
                                    class="h-32 rounded-lg w-full object-cover"
                                    src="https://source.unsplash.com/random/?nature?sig={{ $freelancer->id }}"
                                    alt="{{ $freelancer->name }} generated image"
                                >
                            </div>
                            <div class="absolute top-24 bg-white rounded-full left-4 p-1">
                                <a href="{{ route('client.freelancers.show', $freelancer) }}">
                                    <img
                                        class="h-16 w-16 rounded-full object-cover"
                                        src="{{ $freelancer->profile_image }}"
                                        alt="{{ $freelancer->name }} profile picture"
                                    >
                                </a>

                            </div>
                            <div class="z-30 mt-36 pt-2">
                                <!-- 20 chars max replace with ... -->
                                <h3 class="text-md font-semibold">{{ strlen($freelancer->name) > 18 ? substr($freelancer->name, 0, 18) . '...' : $freelancer->name }}</h3>
                            </div>
                        </div>
                        <div class="mt-4 flex justify-between items-center">
                            <!-- Messages .create route -->
                            <a href="{{ route('client.freelancers.show', $freelancer) }}"
                                 class="btn font-normal custom-btn">
                                <span class="font-normal normal-case">
                                    View Profile <i class="fa-solid fa-arrow-right"></i>
                                </span>
                            </a>

                            <!-- Mail, phone and message buttons -->
                            <div class="flex gap-2 justify-between">
                                <!-- Mail to -->
                                <div class="phone btn btn-ghost btn-sm h-8 w-8 rounded-[8px] bg-green-500 p-2 text-white ring-1 ring-gray-300 ring-opacity-50 ring-offset-1 transition duration-300 border-none hover:bg-blue-600"
                                     onclick="window.location.href='mailto:{{ $freelancer->email }}'">
                                    <i class="fa-solid fa-envelope"></i>
                                </div>
                                <!-- Phone -->
                                <div class="phone btn btn-ghost btn-sm h-8 w-8 rounded-[8px] bg-green-500 p-2 text-white ring-1 ring-gray-300 ring-opacity-50 ring-offset-1 transition duration-300 border-none hover:bg-blue-600"
                                     onclick="window.location.href='tel:{{ $freelancer->phone_number }}'">
                                    <i class="fa-solid fa-phone"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
    <div class="mt-4">
        {{ $freelancers->links() }}
    </div>
</div>
