<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Task') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Task editing form -->
            <div class="rounded-[10px] text-gray-800 w-full max-w-md mx-auto p-4">
                <div class=" py-4 backdrop-blur-sm">
                    <h3 class="font-semibold text-lg">Edit Task</h3>
                    <p>
                        Update the form below to edit the task
                    </p>
                    <form class="flex flex-col" wire:submit.prevent="save">
                        @csrf
                        @method('PUT')
                        <label class="mt-4 mb-2" for="title">
                            Title
                        </label>
                        <x-text-input wire:model="title" class="custom-input" id="title" type="text"
                            placeholder="title" name="title" required />

                        <label class="mt-4 mb-2" for="description">
                            Description
                        </label>
                        <textarea wire:model="description" class="custom-textarea ring-1" id="description" type="text"
                            placeholder="description" name="description"></textarea>

                        <label class="mt-4 mb-2" for="due_date">
                            Due Date
                        </label>
                        <x-text-input wire:model="due_date" class="custom-input" id="due_date" type="date"
                            placeholder="due_date" name="due_date" required autofocus autocomplete="due_date" />

                        <label class="mt-4 mb-2" for="priority">
                            Priority
                        </label>
                        <select wire:model="priority" class="custom-input" id="priority" name="priority">
                            <option value="">Select status</option>
                            <option value="high">High</option>
                            <option value="medium">Medium</option>
                            <option value="low">Low</option>
                        </select>

                        <label class="mt-4 mb-2" for="status">
                            Status
                        </label>
                        <select wire:model="status" class="custom-input" id="status" name="status">
                            <option value="">Select status</option>
                            <option value="pending" {{ $task->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="in_progress" {{ $task->status == 'in progress' ? 'selected' : '' }}>In
                                progress</option>
                            <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>Completed
                            </option>
                        </select>

                        <label class="mt-4 mb-2" for="estimated_duration">
                            Estimated Duration
                        </label>
                        <x-text-input wire:model="estimated_duration" class="custom-input" id="estimated_duration"
                            type="text" placeholder="estimated_duration" name="estimated_duration" required autofocus
                            autocomplete="estimated_duration" />

                        <label class="mt-4 mb-2" for="project_id">
                            Project
                        </label>
                        <select wire:model="project_id" class="custom-input" id="project_id" name="project_id">
                            <option value="">Select a project</option>
                            @foreach ($projects as $project)
                                <option value="{{ $project->id }}"
                                    {{ old('project_id') == $project->id ? 'selected' : '' }}>{{ $project->name }}
                                </option>
                            @endforeach
                        </select>

                        <button class="custom-input btn-info mt-4" type="submit">Update Task</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
