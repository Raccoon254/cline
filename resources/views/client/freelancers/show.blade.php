<x-client-layout>
    <div class=" text-gray-900 p-4">
        <div class="flex items-center justify-between">
            <div class="message flex flex-col">
                <span>
                    <img src="{{ $freelancer->profile_picture}}" alt="{{ $freelancer->name }}" class="rounded-full h-20 mb-3 w-20">
                    {{ $freelancer->name }}
                </span>
                    <span class="text-xs text-gray-700">
                    Has been a member since {{ $freelancer->created_at->diffForHumans() }} and has completed {{ $freelancer->projects->count() }} projects
                </span>
            </div>
            <!-- Message button -->
            <div class="ml-auto">
                <a href="{{ route('messages.create', $freelancer) }}" class="btn custom-btn">
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
                            <td class="border px-4 py-2">{{ $freelancer->name }}</td>
                        </tr>
                        <tr>
                            <td class="border px-4 py-2"><i class="fas fa-envelope"></i> Email</td>
                            <td class="border px-4 py-2">{{ $freelancer->email }}</td>
                        </tr>
                        <tr>
                            <td class="border px-4 py-2"><i class="fas fa-briefcase"></i> Role</td>
                            <td class="border px-4 py-2">{{ $freelancer->role }}</td>
                        </tr>
                        <tr>
                            <td class="border px-4 py-2"><i class="fas fa-phone"></i> Phone Number</td>
                            <td class="border px-4 py-2">{{ $freelancer->phone_number }}</td>
                        </tr>
                        <tr>
                            <td class="border px-4 py-2"><i class="fas fa-clock"></i> Last Login</td>
                            <td class="border px-4 py-2">{{ $freelancer->last_login_at ?? 'Never' }}</td>
                        </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-client-layout>
