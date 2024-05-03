<x-app-layout>
    <div class=" text-gray-900 p-4">
        <div class="flex items-end p-4 rounded-2xl justify-between relative">
            <div class="absolute top-0 p-4 rounded-2xl left-0 w-full h-full" style="background: url('{{ $client->profile_image }}') no-repeat center center / cover; opacity: 0.2;">

            </div>
            <div class="message flex flex-col">
                <span>
                    <img src="{{ $client->profile_image}}" alt="{{ $client->name }}"
                         class="rounded-full object-cover h-20 mb-3 w-20">
                    {{ $client->name }}
                </span>
                <span class="text-xs text-gray-700">
                    Has been a member since {{ $client->created_at->diffForHumans() }} and has completed {{ $client->projects->count() }} projects
                </span>
            </div>
            <!-- Message button -->
            <div class="ml-auto">
                <a href="{{ route('messages.create', $client) }}" class="btn custom-btn">
                    <i class="fa-solid fa-message"></i>
                    Message
                </a>
            </div>
        </div>

        <!-- Page Content -->
        <div class="py-4">
            <div class="w-full h-full">
                <div class="w-full h-full">
                    <table data-theme="light" class="table table-auto table-zebra w-full">
                        <tbody>
                        <tr>
                            <td class="px-4 py-3"><i class="fas mr-2 fa-user"></i> Name</td>
                            <td class="px-4 py-3">{{ $client->name }}</td>
                        </tr>
                        <tr>
                            <td class="px-4 py-3"><i class="fas mr-2 fa-envelope"></i> Email</td>
                            <td class="px-4 py-3">{{ $client->email }}</td>
                        </tr>
                        <tr>
                            <td class="px-4 py-3"><i class="fas mr-2 fa-briefcase"></i> Role</td>
                            <td class="px-4 py-3">{{ $client->role }}</td>
                        </tr>
                        <tr>
                            <td class="px-4 py-3"><i class="fas mr-2 fa-phone"></i> Phone Number</td>
                            <td class="px-4 py-3">{{ $client->phone_number }}</td>
                        </tr>
                        <tr>
                            <td class="px-4 py-3"><i class="fas mr-2 fa-clock"></i> Last Login</td>
                            <td class="px-4 py-3">{{ $client->last_login_at ?? 'Never' }}</td>
                        </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
