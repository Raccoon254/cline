<x-app-layout>

    <div class="p-2 rounded-lg overflow-x-hidden w-full">
        <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Project') }}
                </h2>
            </x-slot>

            <div class="flex-col rounded-xl overflow-x-hidden mx-auto sm:px-6 lg:px-8">
                <div class="flex items-center justify-between mt-4">
                    <div class="avatar center h-14 w-14 rounded-full flex items-center justify-center">
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

                    <div>
                        <i class="fas ring-1 btn btn-sm btn-circle btn-ghost fa-user text-gray-500 mr-2"></i>
                        <span class="text-gray-600">{{ $project->user->name }}</span>
                    </div>
                </div>
                <h3 class="font-bold text-xl mb-4">{{ $project->name }}</h3>
                <p class="text-gray-700 text-sm">{{ Str::limit($project->description, 70) }}</p>
                <div class="mt-4">
                    <div>
                        <i class="fas fa-dollar-sign text-gray-500 mr-2"></i>
                        <span class="text-gray-600">{{ $project->price }}</span>
                    </div>
                    <div class="relative mt-10">
                        <div class="relative">
                            <div class="absolute flex flex-col -top-4 -mt-2" style="left: {{ $project->progress() }}%">
                                <span class="text-gray-500 text-xs">{{ $project->progress() }}%</span>
                                <i class="fas fa-caret-down text-gray-500"></i>
                            </div>
                            <progress class="progress progress-success w-full" value="{{ $project->progress() }}"
                                max="100"></progress>
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

                <button onclick="window.location='{{ route('projects.edit', $project) }}'"
                    class="bg-green-500 hover:bg-green-700 text-white text-sm font-bold py-1 px-2 w-full mt-6 rounded">
                    Edit Project
                </button>

                <div class="mt-8">
                    <div class="flex items-center justify-between mt-4">
                        <h4 class="font-bold text-lg mb-2">Project Tasks:</h4>
                        <div class="space-x-2">
                            <button onclick="window.location='{{ route('tasks.create') }}'"
                                class="bg-blue-500 hover:bg-blue-700 text-white text-sm font-bold py-1 px-2 rounded">
                                Create Task
                            </button>
                        </div>
                    </div>
                    @if ($project->tasks->isEmpty())
                        <p class="text-gray-500 h-96">No tasks for this project.</p>
                    @else
                        <div class="w-full flex flex-wrap space-x-4 rounded">
                            @foreach ($project->tasks as $task)
                                <div class="group relative bg-white shadow rounded-lg p-4 mb-4 w-80">
                                    <div
                                        class="flex space-x-2 absolute top-0 right-0 m-2 opacity-0 group-hover:opacity-100">
                                        <button onclick="window.location='{{ route('tasks.edit', $task->id) }}'"
                                            class="bg-blue-500 hover:bg-blue-700 text-white text-sm font-bold py-1 px-2 rounded">
                                            Edit
                                        </button>
                                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                class="bg-red-500 hover:bg-red-700 text-white text-sm font-bold py-1 px-2 rounded">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="font-semibold">{{ $task->user }}</span>
                                        @switch($task->priority)
                                            @case('high')
                                                <span class="text-red-500 text-xs">{{ $task->priority }}</span>
                                            @break

                                            @case('medium')
                                                <span class="text-yellow-500 text-xs">{{ $task->priority }}</span>
                                            @break

                                            @case('low')
                                                <span class="text-green-500 text-xs">{{ $task->priority }}</span>
                                            @break

                                            @default
                                                <span class="text-xs">{{ $task->priority }}</span>
                                        @endswitch
                                    </div>
                                    <div class="mt-2">
                                        <h3 class="font-semibold">{{ $task->title }}</h3>
                                        <p class="text-gray-600">{{ $task->description }}</p>
                                    </div>
                                    <div class="mt-2 flex justify-between items-center">
                                        <span class="text-gray-500 font-semibold text-sm cursor-pointer"
                                            onclick="window.location='{{ route('projects.show', $task->project) }}'">{{ $task->project->name }}</span>
                                        <span class="text-gray-500 text-sm">
                                            <i class="fas fa-calendar-alt mr-1 text-sm"></i>
                                            {{ $task->due_date }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>


                        {{-- <div class="mt-4">
                            {{ $project->tasks->links() }}
                        </div> --}}
                    @endif
                    <form action="{{ route('projects.destroy', $project) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button
                            class="bg-red-500 hover:bg-red-700 text-white text-sm font-bold py-1 px-2 w-full mt-6 rounded">
                            Delete Project
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
