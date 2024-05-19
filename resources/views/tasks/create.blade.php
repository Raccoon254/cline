<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Task') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Task creation form -->
            <div class="rounded-[10px] text-gray-800 w-full max-w-md mx-auto p-4">
                <div class=" py-4 backdrop-blur-sm">
                    <h3 class="font-semibold text-lg">New Task</h3>
                    <p>
                        Fill in the form below to create a new task
                    </p>
                    <form class="flex flex-col" action="{{ route('tasks.store') }}" method="POST">
                        @csrf
                        <label class="mt-4 mb-2" for="title">
                            Title
                        </label>
                        <input class="custom-input" id="title" type="text" placeholder="title" name="title"
                            value="{{ old('title') }}">

                        <label class="mt-4 mb-2" for="description">
                            Description
                        </label>
                        <textarea class="custom-textarea ring-1" id="description" type="text" placeholder="description" name="description">{{ old('description') }}</textarea>

                        <label class="mt-4 mb-2" for="due_date">
                            Due Date
                        </label>
                        <input class="custom-input" id="due_date" type="date" placeholder="due_date" name="due_date"
                            value="{{ old('due_date') }}">

                        <label class="mt-4 mb-2" for="priority">
                            Priority
                        </label>
                        <input class="custom-input" id="priority" type="text" placeholder="priority" name="priority"
                            value="{{ old('priority') }}">

                        <label class="mt-4 mb-2" for="status">
                            Status
                        </label>
                        <input class="custom-input" id="status" type="text" placeholder="status" name="status"
                            value="{{ old('status') }}">

                        <label class="mt-4 mb-2" for="estimated_duration">
                            Estimated Duration
                        </label>
                        <input class="custom-input" id="estimated_duration" type="text"
                            placeholder="estimated_duration" name="estimated_duration"
                            value="{{ old('estimated_duration') }}">

                        <label class="mt-4 mb-2" for="project_id">
                            Project
                        </label>
                        <select class="custom-input" id="project_id" name="project_id">
                            <option value="">Select a project</option>
                            @foreach ($projects as $project)
                                <option value="{{ $project->id }}"
                                    {{ old('project_id') == $project->id ? 'selected' : '' }}>{{ $project->name }}
                                </option>
                            @endforeach
                        </select>

                        <button class="custom-input btn-info mt-4" type="submit">Create Task</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
