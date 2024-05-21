<div class="p-2 rounded-lg overflow-x-hidden w-full">

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Tasks') }}
        </h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="label flex flex-col center mb-4">
            <label class="w-full relative z-20">
                <input type="text" wire:model.live="search" class="w-full p-2 rounded-lg border border-gray-200"
                    placeholder="Search Tasks...">
                <i class="fa-solid fa-search absolute right-3 top-[50%] transform -translate-y-1/2 text-gray-400"></i>
            </label>
        </div>
        <div class="overflow-hidden sm:rounded-lg">
            <div class="lg:flex lg:space-x-4 space-y-4 lg:space-y-0 p-4 w-full">
                <div class="w-full lg:w-1/3 bg-gray-200 p-4 rounded" id="pending" data-status="pending">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">Todo</h2>
                    @foreach ($tasks as $task)
                        @if ($task->status == 'pending')
                            <div class="group relative bg-white shadow rounded-lg p-4 mb-4 cursor-pointer"
                                data-id="{{ $task->id }}">
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
                        @endif
                    @endforeach
                    <button onclick="window.location='{{ route('tasks.create') }}'"
                        class="font-bold py-2 px-4 rounded mt-4">
                        <i class="fas fa-plus mr-2"></i>
                        Add New Task
                    </button>
                </div>

                <div class="w-full lg:w-1/3 bg-gray-200 p-4 rounded" id="in_progress" data-status="in_progress">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">In Progress</h2>
                    @foreach ($tasks as $task)
                        @if ($task->status == 'in_progress')
                            <div class="group relative bg-white shadow rounded-lg p-4 mb-4 cursor-pointer"
                                data-id="{{ $task->id }}">
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
                        @endif
                    @endforeach
                    <button onclick="window.location='{{ route('tasks.create') }}'"
                        class="font-bold py-2 px-4 rounded mt-4">
                        <i class="fas fa-plus mr-2"></i>
                        Add New Task
                    </button>
                </div>

                <div class="w-full lg:w-1/3 bg-gray-200 p-4 rounded" id="completed" data-status="completed">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">Completed</h2>
                    @foreach ($tasks as $task)
                        @if ($task->status == 'completed')
                            <div class="group relative bg-white shadow rounded-lg p-4 mb-4 cursor-pointer"
                                data-id="{{ $task->id }}">
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
                        @endif
                    @endforeach
                    <button onclick="window.location='{{ route('tasks.create') }}'"
                        class="font-bold py-2 px-4 rounded mt-4">
                        <i class="fas fa-plus mr-2"></i>
                        Add New Task
                    </button>
                </div>
            </div>

            {{-- <div class="mt-4">
                {{ $tasks->links() }}
            </div> --}}
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

    <script>
        $(function() {
            $(".group").draggable({
                revert: "invalid",
            });

            $("#pending, #in_progress, #completed").droppable({
                accept: ".group",
                tolerance: "intersect",
                drop: function(event, ui) {
                    var taskId = ui.draggable.data('id');
                    var status = $(this).data('status');

                    $.ajax({
                        url: '/tasks/' + taskId,
                        type: 'PATCH',
                        data: {
                            status: status,
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(result) {
                            // Clone the draggable element, reinitialize its draggable properties, and append it to the droppable element
                            var clonedElement = ui.helper.clone().removeAttr('style')
                                .draggable({
                                    revert: "invalid",
                                });
                            $("h2", this).after(clonedElement);
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.log(textStatus, errorThrown);
                        }
                    });

                    var clonedElement = ui.helper.clone().removeAttr('style').draggable({
                        revert: "invalid",
                    });
                    $("h2", this).after(clonedElement);

                    // Remove the original draggable element
                    ui.helper.remove();
                }
            });
        });
    </script>
</div>
