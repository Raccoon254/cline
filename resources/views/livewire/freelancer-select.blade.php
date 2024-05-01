<div>

    <div class="relative">
        <input type="text" wire:model.live="searchTerm" class="input w-full ring-1" placeholder="Search freelancers...">
        <div class="absolute top-[50%] right-4 transform -translate-y-1/2">
            <i class="fas fa-search"></i>
        </div>
    </div>

    <ul class="mt-2 py-2 rounded-md h-auto max-h-[300px] overflow-y-scroll overflow-x-clip stripped-list">
        <li class="p-2 bg-gray-800 text-gray-200">
            Top Freelancers
        </li>
        @foreach ($freelancers as $freelancer)
            <li wire:click="selectFreelancer({{ $freelancer->id }})" class="cursor-pointer p-2 rounded-sm hover:bg-gray-800">
                {{ $freelancer->name }}
            </li>
        @endforeach
        @if (count($freelancers) == 0)
            <li class="p-2">No freelancers found</li>
        @endif
    </ul>

    <label for="freelancer"></label><input class="input hidden ring-1" id="freelancer" type="text" placeholder="freelancer_id" value="{{ $selectedFreelancer }}" >
    <!-- If we have a selected freelancer, show their name -->
    @if ($selectedFreelancer)
        <div class="mt-2 p-2 bg-gray-800 rounded-md text-gray-200">
            {{ $selectedFreelancerName }}
        </div>
    @endif
</div>
