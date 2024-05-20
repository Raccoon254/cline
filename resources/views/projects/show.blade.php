<x-app-layout>

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

        <div class="mt-4">
            <h4 class="font-bold text-lg mb-2">Project Tasks:</h4>
            @if ($project->tasks->isEmpty())
                <p class="text-gray-500">No tasks for this project.</p>
            @else
                <table class="table w-full table-pin-rows table-pin-cols">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Due Date</th>
                            <th>Priority</th>
                            <th>Status</th>
                            <th>Estimated Duration</th>
                            <th>Project Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($project->tasks as $task)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $task->title }}</td>
                                <td>{{ $task->description }}</td>
                                <td>{{ $task->due_date }}</td>
                                <td>{{ $task->priority }}</td>
                                <td>
                                    @if ($task->status == 'completed')
                                        <i class="fas fa-check text-green-500 text-lg"></i>
                                    @elseif($task->status == 'pending')
                                        <i class="fas fa-clock text-yellow-500 text-lg"></i>
                                    @elseif($task->status == 'in_progress')
                                        <i class="fas fa-spinner text-blue-500 text-lg"></i>
                                    @else
                                        <i class="fas fa-check text-green-500 text-lg"></i>
                                    @endif
                                </td>
                                <td>{{ $task->estimated_duration }}</td>
                                <td>{{ $task->project->name }}</td>
                                <td class="space-x-2 flex">
                                    <a href="{{ route('tasks.edit', $task->id) }}" class="text-md text-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-md" style="color: red">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{-- <div class="mt-4">
                    {{ $project->tasks->links() }}
                </div> --}}
            @endif
        </div>
    </div>
</x-app-layout>
