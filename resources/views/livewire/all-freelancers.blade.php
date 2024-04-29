<div class="clients p-2 rounded-lg h-[80vh] overflow-y-auto overflow-x-visible w-full">
    <div class="label flex flex-col center mb-4">
        <label class="w-full relative z-20">
            <input type="text" wire:model.live="search" class="w-full p-2 rounded-lg border border-gray-200" placeholder="Type to search...">
            <i class="fas fa-search absolute right-3 top-[50%] transform -translate-y-1/2 text-gray-400"></i>
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
        <div class="grid gap-4 grid-cols-1 p-2 sm:grid-cols-2 md:grid-cols-2">
            @foreach($freelancers as $freelancer)
                <a class="client-card tooltip tooltip-warning bg-white p-4 rounded-lg" data-tip="View {{ $freelancer->name }}" data-for="client-tooltip" href="{{ route('clients.show', $freelancer) }}">
                    <div class="top grid items-center gap-2 grid-cols-4">
                        <div class="w-8 p-[1px] animate-scale rounded-full ring-1">
                            <img
                                class="rounded-full w-full h-full object-cover" src="{{ $freelancer->profile_picture }}" alt="{{ $freelancer->name }} profile picture">
                        </div>
                        <div class="name col-span-3 overflow-x-clip">
                        <span class="text-gray-900 block font-medium">
                            {{ Str::limit($freelancer->name, 13) }}
                        </span>
                            <span class="text-xs text-gray-700">
                            {{ $freelancer->email }}
                        </span>
                        </div>
                    </div>
                    <div class="mid mt-2">
                        <div class="text-xs text-gray-700">
                            {{ $freelancer->phone }}
                        </div>
                    </div>
                    <div class="bottom mt-2">
                        <div class="text-xs text-gray-700">
                            {{ $freelancer->address }}
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
