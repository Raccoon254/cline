<div>
    <div class="flex h-[93vh]">
        <div class="bg-gray-100 w-1/4 border-r-none">
            <div class="p-2 border-b">
                <input wire:model.live="search" class="w-full rounded-[10px] border-2 border-gray-300 p-3 pl-4 ring-1 ring-gray-300 ring-offset-1 transition-all duration-300 ease-in-out focus:border-blue-300 focus:outline-none bg-gray-200 px-4 py-2" type="text" placeholder="Search users">
            </div>
            <div class="overflow-y-auto h-[calc(100vh-8rem)]">
                @foreach($users as $user)
                    <div wire:click="selectRecipient({{ $user->id }})" class="{{ $selectedRecipientId == $user->id ? 'bg-gray-200' : '' }} p-4 border-b cursor-pointer hover:bg-gray-200">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <img src="{{ $user->profile_picture }}" class="w-10 h-10 ring-1 ring-gray-400 rounded-full mr-4" alt="{{ $user->name }}">
                                <h3 class="font-normal text-gray-800">{{ $user->name }}</h3>
                            </div>
                            <div>
                                <span class="text-xs text-gray-500">{{ $user->unreadMessagesCount($user->id) }} unread</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="flex flex-col justify-between w-3/4 bg-white shadow-lg rounded-lg h-full overflow-hidden">
            @if($selectedRecipient)
                <div class="bg-gray-100 py-[10px] px-3 flex items-center justify-between">
                    <div class="flex items-center">
                        <img src="{{ $selectedRecipient->profile_picture }}" class="w-10 h-10 ring-1 ring-gray-400 rounded-full mr-4" alt="{{ $selectedRecipient->name }}">
                        <h3 class="font-normal text-gray-800">{{ $selectedRecipient->name }}</h3>
                    </div>
                </div>
                <div class="overflow-y-auto">
                    <div class="p-6 space-y-4">
                        @foreach($messages as $message)
                            <div class="{{ $message->sender_id == Auth::id() ? 'text-right' : 'text-left' }}">
                                <div class="inline-block {{ $message->sender_id == Auth::id() ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-800' }} rounded-lg px-1 py-1 max-w-3/4">
                                    {{ $message->body }}
                                    @if ($message->attachment_path)
                                        <div class="mt-1 w-full h-32 overflow-hidden">
                                            @if (in_array($message->attachment_type, ['image/jpeg', 'image/png']))
                                                <img src="{{ Storage::url($message->attachment_path) }}" alt="Attachment" class="w-full rounded-[4px] h-full object-cover">
                                            @elseif ($message->attachment_type == 'application/zip')
                                                <a href="{{ Storage::url($message->attachment_path) }}">Download Attachment</a>
                                            @endif
                                        </div>
                                    @endif
                                    <!-- Message timestamp -->
                                    <div class="text-[10px] text-gray-100 mt-1">{{ $message->time }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="bg-gray-100 px-2 py-4 relative flex items-center">
                    @if ($attachment)
                        <img class="absolute -top-36 right-6 w-48 h-36 object-cover rounded-md" src="{{ $attachment->temporaryUrl() }}" alt="Attachment">
                    @endif
                    <input wire:model.live="newMessage" wire:keydown.enter="newMessage" class="w-full rounded-[10px] border-2 border-gray-300 p-3 pl-4 ring-1 ring-gray-300 ring-offset-1 transition-all duration-300 ease-in-out focus:border-blue-300 focus:outline-none bg-gray-200 px-4 " type="text" placeholder="Type your message...">
                    <div class="absolute md:right-2 lg:right-4 top[50%] transform[-50%] flex items-center">
                        <!-- Hidden file input -->
                        <input wire:model.live="attachment" type="file" id="fileInput" style="display: none;">
                        <!-- Clip icon for opening file dialog -->
                        <button class="btn btn-sm btn-circle ml-2" onclick="document.getElementById('fileInput').click();">
                            <i class="fas fa-paperclip"></i>
                        </button>
                        <!-- Send message button -->
                        <button wire:click="sendMessage" class="btn btn-sm btn-circle btn-primary ml-4">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </div>
                </div>

            @else
                <div class="flex items-center justify-center h-full">
                    <p class="text-gray-500">Select a user to start chatting.</p>
                </div>
            @endif
        </div>
    </div>
</div>
