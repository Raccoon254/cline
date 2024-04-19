<div class="clients p-2 rounded-lg h-[80vh] overflow-y-auto">
    <div class="label flex flex-col center mb-4">
        <input type="text" wire:model.live="search" class="w-full p-2 rounded-lg border border-gray-200" placeholder="Search clients...">
    </div>

    <div class="grid gap-4 grid-cols-1 sm:grid-cols-2 md:grid-cols-2">
        @foreach($clients as $client)
            <div class="client-card bg-white p-4 rounded-lg mb-4">
                <div class="top flex items-center">
                    <div class="avatar w-10 h-10 mr-4">
                        <img src="{{ $client->profile_picture }}" alt="avatar" class="rounded-full w-full h-full object-cover">
                    </div>
                    <div class="name">
                        <span class="text-gray-900 block font-medium">
                            {{ $client->name }}
                        </span>
                        <span class="text-xs text-gray-700">
                            {{ $client->email }}
                        </span>
                    </div>
                </div>
                <div class="mid mt-2">
                    <div class="text-xs text-gray-700">
                        {{ $client->phone }}
                    </div>
                </div>
                <div class="bottom mt-2">
                    <div class="text-xs text-gray-700">
                        {{ $client->address }}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
