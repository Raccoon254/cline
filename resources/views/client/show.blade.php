<x-app-layout>
    <div class=" text-gray-900 p-4">
        <div class="flex items-center justify-between">
            <div class="message flex flex-col">
                <span>
                    <img src="{{ $client->profile_picture}}" alt="{{ $client->name }}"
                         class="rounded-full h-20 mb-3 w-20">
                    {{ $client->name }}
                </span>
                <span class="text-xs text-gray-700">
                    Has been a member since {{ $client->created_at->diffForHumans() }} and has completed {{ $client->projects->count() }} projects
                </span>
            </div>
            <!-- Message button -->
            <div class="ml-auto">
                <a href="{{ route('messages.create', $client) }}" class="btn custom-btn">
                    <i class="fas fa-envelope"></i>
                    Message
                </a>
            </div>
        </div>

        <!-- Page Content -->
        <div class="py-4">
            <div class="w-full h-full">
                <div class="bg-white w-full h-full p-1 rounded-md">
                    <table class="table-auto rounded-md w-full">
                        <tbody>
                        <tr>
                            <td class="border px-4 py-2"><i class="fas fa-user"></i> Name</td>
                            <td class="border px-4 py-2">{{ $client->name }}</td>
                        </tr>
                        <tr>
                            <td class="border px-4 py-2"><i class="fas fa-envelope"></i> Email</td>
                            <td class="border px-4 py-2">{{ $client->email }}</td>
                        </tr>
                        <tr>
                            <td class="border px-4 py-2"><i class="fas fa-briefcase"></i> Role</td>
                            <td class="border px-4 py-2">{{ $client->role }}</td>
                        </tr>
                        <tr>
                            <td class="border px-4 py-2"><i class="fas fa-phone"></i> Phone Number</td>
                            <td class="border px-4 py-2">{{ $client->phone_number }}</td>
                        </tr>
                        <tr>
                            <td class="border px-4 py-2"><i class="fas fa-clock"></i> Last Login</td>
                            <td class="border px-4 py-2">{{ $client->last_login_at ?? 'Never' }}</td>
                        </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
