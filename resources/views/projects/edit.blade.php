<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Project') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Project editing form -->
            <div class="rounded-[10px] text-gray-800 w-full max-w-md mx-auto p-4">
                <div class=" py-4 backdrop-blur-sm">
                    <h3 class="font-semibold text-lg">Edit Project</h3>
                    <p>
                        Fill in the form below to edit the project
                    </p>
                    <form class="flex flex-col" action="{{ route('projects.update', ['id' => $project->id]) }}"
                        method="POST">
                        @csrf
                        @method('PUT')
                        <label class="mt-4 mb-2" for="name">
                            Name
                        </label>
                        <input class="custom-input" id="name" type="text" placeholder="name" name="name"
                            value="{{ $project->name }}">

                        <label class="mt-4 mb-2" for="description">
                            Description
                        </label>
                        <textarea class="custom-textarea ring-1" id="description" type="text" placeholder="description" name="description">{{ $project->description }}</textarea>

                        <label class="mt-4 mb-2" for="end_date">
                            End Date
                        </label>
                        <input class="custom-input" id="end_date" type="date" placeholder="end_date" name="end_date"
                            value="{{ date('Y-m-d', strtotime($project->end_date)) }}">

                        @if ($role != 'client')
                            <label class="mt-4 mb-2" for="client">
                                Client
                            </label>
                            <select class="custom-input" id="client" name="client_id">
                                <option value="">Select a client</option>
                                @foreach ($clients as $client)
                                    <option value="{{ $client->id }}"
                                        {{ $project->client_id == $client->id ? 'selected' : '' }}>{{ $client->name }}
                                    </option>
                                @endforeach
                            </select>
                        @endif

                        @if ($role == 'client')
                            <label class="mt-4 mb-2" for="freelancer">
                                Freelancer
                            </label>
                            <select class="custom-input" id="freelancer" name="user_id">
                                <option value="">Select a freelancer</option>
                                @foreach ($freelancers as $freelancer)
                                    <option value="{{ $freelancer->id }}"
                                        {{ $project->user_id == $freelancer->id ? 'selected' : '' }}>
                                        {{ $freelancer->name }}</option>
                                @endforeach
                            </select>
                        @endif

                        <!-- Price -->
                        <label class="mt-4 mb-2" for="price">
                            Price
                        </label>
                        <input class="custom-input" id="price" type="number" placeholder="price" name="price"
                            value="{{ $project->price }}">

                        <button class="custom-input btn-info mt-4" type="submit">Update Project</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
