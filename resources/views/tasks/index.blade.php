<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden sm:rounded-lg">
                @if ($tasks->isEmpty())
                    <p class="text-gray-500">No tasks.</p>
                @else
                    <ul class="list-disc list-inside text-gray-700">
                        @foreach ($tasks as $task)
                            <li>
                                <h4>{{ $task->title }}</h4>
                                <p>Description: {{ $task->description }}</p>
                                <p>Due Date: {{ $task->due_date }}</p>
                                <p>Priority: {{ $task->priority }}</p>
                                <p>Status: {{ $task->status }}</p>
                                <p>Estimated Duration: {{ $task->estimated_duration }}</p>
                                <p>Project ID: {{ $task->project_id }}</p>
                                <a href="{{ route('tasks.edit', $task->id) }}" class="text-blue-500">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
