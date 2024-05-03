<div class="">
    {{--
    TODO
    -Show the most important project as bigger than the rest
    --}}
    <!-- If we have no projects and no search term -->
    @if($projects->isEmpty() && !$searchTerm)
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h3 class="text-lg py-2 center font-semibold">No Projects Found</h3>
        </div>
    @else
        <h3 class="text-lg py-2 center font-semibold">All Projects</h3>
        <!-- Search -->
        <div class="flex my-2 items-center">
            <input wire:model.live="searchTerm" type="text" class="w-full p-2 border border-gray-300 rounded-lg"
                   placeholder="Search Projects...">
        </div>
        <div class="grid my-2 grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-2">
            @foreach($projects->sortByDesc('start_date') as $project)
                <div class="client-card ring-1 ring-gray-500 ring-offset-1 border ring-opacity-10 bg-white rounded-xl p-1">
                    <h3 class="font-bold text-xl mb-4">{{ $project->name }}</h3>
                    <p class="text-gray-700 text-base">{{ $project->description }}</p>
                    <div class="mt-4">
                        <p class="text-gray-500">Price: {{ $project->price }}</p>
                        <p class="text-gray-500">Start Date: {{ $project->start_date }}</p>
                        <p class="text-gray-500">End Date: {{ $project->end_date }}</p>
                        <p class="text-gray-500">Status: {{ $project->status }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
    <!-- Pagination -->
    <div class="py-4">
        {{ $projects->links() }}
    </div>
</div>
