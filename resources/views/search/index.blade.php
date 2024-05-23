<div class="search flex md:w-[70%] items-center">
    <i class="fas fa-search"></i>
    <label class="w-full">
        <input wire:model.live="search" type="text"
            class="input input-sm w-full rounded-none input-ghost text-gray-800 input-no-focus bg-white pl-4"
            placeholder="Tap here and type..." />
    </label>

    <!-- If search is not empty, show a modal with the search results -->
    @if ($search)
        <div class="bg-black z-[100000000] bg-opacity-60 fixed inset-0">
            <div
                class="search-results z-[100000001] absolute top-20 md:w-1/2 bg-white shadow-lg rounded-lg mt-2 left-[50%] transform translate-x-[-50%]">
                @if ($searchResults->count() > 0)
                    @foreach ($searchResults as $result)
                        <a href="{{ route('search.show', $result->id) }}" class="block p-2 hover:bg-gray-100">
                            <p class="text-gray-800">{{ $result->name }}</p>
                        </a>
                    @endforeach
                @else
                    <p class="p-2 text-gray-800">No results found for "{{ $search }}"</p>
                @endif
            </div>
        </div>
    @endif
</div>
