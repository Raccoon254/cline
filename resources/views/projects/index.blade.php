<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Projects') }}
        </h2>
    </x-slot>
    <h2 class="text-2xl center font-semibold text-gray-800 leading-tight p-6">
        All Projects
    </h2>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden sm:rounded-lg">
                <div class="grid grid-cols-1 p-3 md:grid-cols-2 lg:grid-cols-2 gap-6">
                    @foreach ($projects as $project)
                        <div class="bg-gray-200 text-gray-900 shadow-sm m-1 rounded-[20px] p-6">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-semibold">{{ $project->name }}</h3>
                                <span class="text-gray-900 text-sm">
                                    @if ($project->status == 'active')
                                        <i class="fas fa-circle text-green-500 mr-2"></i>Active
                                    @elseif ($project->status == 'completed')
                                        <i class="fas fa-check-circle text-blue-500 mr-2"></i>Completed
                                    @elseif ($project->status == 'archived')
                                        <i class="fas fa-archive text-gray-500 mr-2"></i>Archived
                                    @elseif ($project->status == 'pending')
                                        <i class="fas fa-clock text-yellow-500 mr-2"></i>Pending
                                    @elseif ($project->status == 'cancelled')
                                        <i class="fas fa-times-circle text-red-500 mr-2"></i>Cancelled
                                    @elseif ($project->status == 'in_progress')
                                        <i class="fas fa-spinner text-blue-500 mr-2"></i>In Progress
                                    @endif
                                </span>
                            </div>
                            <p class="text-gray-600 text-sm mt-2">{{ $project->description }}</p>
                            <div class="flex items-center justify-between mt-4">
                                <div>
                                    <i class="fas ring-1 btn btn-sm btn-circle btn-ghost fa-user text-gray-500 mr-2"></i>
                                    <span class="text-gray-600">{{ $project->user->name }}</span>
                                </div>
                                <div>
                                    <i class="fas fa-dollar-sign text-gray-500 mr-2"></i>
                                    <span class="text-gray-600">{{ $project->price }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
