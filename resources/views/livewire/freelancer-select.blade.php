<div>
    <div class="relative">
        <input type="text" wire:model.live="searchTerm" class="input w-full ring-1" placeholder="Search freelancers...">
        <div class="absolute top-[50%] right-4 transform -translate-y-1/2">
            <i class="fas fa-search"></i>
        </div>
    </div>
    <ul class="bg-gray-100 mt-2 rounded-md bg-opacity-5 stripped-list">
        @foreach ($freelancers as $freelancer)
            <li wire:click="selectFreelancer({{ $freelancer->id }})" class="{{ $selectedFreelancer == $freelancer->id ? 'bg-gray-800' : '' }} cursor-pointer p-2 rounded-md hover:bg-gray-800">
                {{ $freelancer->name }}
            </li>
        @endforeach
        @if (count($freelancers) == 0)
            <li class="p-2">No freelancers found</li>
        @endif
    </ul>
</div>
