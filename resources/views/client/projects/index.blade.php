<x-client-layout>
    @foreach ($projects as $project)
        <div class="bg-white shadow-md rounded-md p-4 mb-4">
            {{ $project->name }}
        </div>
        
    @endforeach
</x-client-layout>
