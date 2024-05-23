<div class="">
    {{--
    TODO
    -Show the most important project as bigger than the rest
    --}}
    <!-- If we have no projects and no search term -->
    @if ($projects->isEmpty() && !$searchTerm)
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
        <div class="grid gap-4 grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($projects->sortByDesc('start_date') as $project)
                <div class="client-card cursor-pointer border ring-1 ring-gray-500 ring-offset-1 flex-col ring-opacity-10 bg-white rounded-xl p-4"
                    onclick="window.location.href='{{ route('projects.show', $project) }}'">
                    <!-- Avatar Like icon depending on the project status -->
                    <div class="w-full center">
                        <div class="avatar center h-14 w-14 rounded-full flex items-center justify-center">
                            <!-- // 'active', 'completed', 'archived', 'pending', 'cancelled', 'in_progress' -->
                            @if ($project->status == 'completed')
                                <i class="fas fa-check text-green-500 text-2xl"></i>
                            @elseif($project->status == 'pending')
                                <i class="fas fa-clock text-yellow-500 text-2xl"></i>
                            @elseif($project->status == 'cancelled')
                                <i class="fas fa-times text-red-500 text-2xl"></i>
                            @elseif($project->status == 'in_progress')
                                <i class="fas fa-spinner text-blue-500 text-2xl"></i>
                            @elseif($project->status == 'archived')
                                <i class="fas fa-archive text-gray-500 text-2xl"></i>
                            @else
                                <i class="fas fa-check text-green-500 text-2xl"></i>
                            @endif
                        </div>
                    </div>
                    <h3 class="font-bold text-xl mb-4">{{ $project->name }}</h3>
                    <!-- Description max 2 lines -->
                    <p class="text-gray-700 text-sm">{{ Str::limit($project->description, 70) }}</p>
                    <div class="mt-4">
                        <p class="text-gray-500">Price: {{ $project->price }}</p>

                        <div class="relative mt-2">
                            <div class="relative">
                                <!-- Icon to point from top at the current day using absolute positioning -->
{{--                                <div class="absolute w-[90%] flex flex-col -top-4 -mt-2"--}}
{{--                                    style="left: {{ $project->progress() }}%">--}}
{{--                                    <span class="text-gray-500 text-xs">{{ $project->progress() }}%</span>--}}
{{--                                    <i class="fas fa-caret-down text-gray-500"></i>--}}
{{--                                </div>--}}
                                <progress class="progress progress-success w-full" value="{{ $project->progress() }}"
                                    max="100">
                                </progress>
                            </div>
                            <div class="flex justify-between text-xs text-gray-500">
                                <span>Start Date: {{ $project->start_date->format('d M Y') }}</span>
                                <span>End Date: {{ $project->end_date->format('d M Y') }}</span>
                            </div>
                        </div>

                        @if (now()->greaterThan($project->end_date))
                            <p class="text-red-500 mt-2">Project is past its deadline!</p>
                        @elseif(now()->greaterThan($project->end_date->subDays(7)))
                            <p class="text-yellow-500 mt-2">Project is close to its deadline!</p>
                        @else
                            <p class="text-green-500 mt-2">Project is within its timeline.</p>
                        @endif
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
