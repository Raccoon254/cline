<div class="p-2 rounded-lg overflow-x-hidden w-full">
    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="label flex flex-col center mb-4">
            <label class="w-full relative z-20">
                <input type="text" wire:model.live="search" class="w-full p-2 rounded-lg border border-gray-200"
                    placeholder="Search Tasks...">
                <i class="fa-solid fa-search absolute right-3 top-[50%] transform -translate-y-1/2 text-gray-400"></i>
            </label>
        </div>
        <div class="overflow-hidden sm:rounded-lg">
            @if ($tasks->isEmpty())
                <p class="text-gray-500">No tasks.</p>
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
                        @foreach ($tasks as $task)
                            <tr>
                                <td>{{ $task->id }}</td>
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
                <div class="mt-4">
                    {{ $tasks->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
