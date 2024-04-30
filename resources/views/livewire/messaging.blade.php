<div>
    @php
        use Illuminate\Support\Facades\Storage;
    @endphp
    <div class="flex h-[93vh]">
        <div class="bg-gray-100 w-1/4 border-r-none">
            <div class="p-2 border-b">
                <input wire:model.live="search"
                       class="message-input rounded-sm"
                       type="text" placeholder="Search users">
            </div>
            <div class="overflow-y-auto h-[calc(100vh-8rem)]">
                @foreach($users as $user)
                    <div wire:click="selectRecipient({{ $user->id }})"
                         class="{{ $selectedRecipientId == $user->id ? 'bg-gray-200' : '' }} p-4 border-b cursor-pointer hover:bg-gray-200">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <img src="{{ $user->profile_picture }}"
                                     class="w-10 h-10 ring-1 ring-gray-400 rounded-full mr-4" alt="{{ $user->name }}">
                                <h3 class="font-normal text-gray-800">{{ $user->name }}</h3>
                            </div>
                            <div>
                                <span
                                    class="text-xs text-gray-500">{{ $user->unreadMessagesCount($user->id) }} unread</span>
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
                        <img src="{{ $selectedRecipient->profile_picture }}"
                             class="w-10 h-10 ring-1 ring-gray-400 rounded-full mr-4"
                             alt="{{ $selectedRecipient->name }}">
                        <h3 class="font-normal text-gray-800">{{ $selectedRecipient->name }}</h3>
                    </div>
                </div>
                <div class="overflow-y-auto">
                    <div class="p-6 space-y-4">
                        @foreach($messages as $message)
                            <div class="{{ $message->sender_id == Auth::id() ? 'text-right' : 'text-left' }} max-w-2/3 mx-auto">
                                <div class="inline-block {{ $message->sender_id == Auth::id() ? 'bg-blue-500 text-white sent-message ' : 'bg-gray-200 text-gray-800 received-message ' }} px-1 py-1/4">
                                    {{ $message->body }}
                                    @if ($message->attachments->count() > 0)
                                        <div class="flex flex-wrap -mx-1">
                                            @foreach($message->attachments as $attachment)
                                                <div class="w-1/3 px-1 mb-2">
                                                    <div class="bg-gray-200 rounded-md overflow-hidden relative">
                                                        @if (in_array($attachment->type, ['image/jpeg', 'image/png', 'image/gif']))
                                                            <img src="{{ Storage::url($attachment->path) }}" alt="Attachment" class="w-full h-32 object-cover">
                                                        @elseif ($attachment->type == 'application/pdf')
                                                            <div class="flex items-center justify-center h-32 bg-red-200">
                                                                <i class="fas fa-file-pdf text-4xl text-red-500"></i>
                                                            </div>
                                                        @elseif ($attachment->type == 'application/zip' || $attachment->type == 'application/x-rar-compressed')
                                                            <div class="flex items-center justify-center h-32 bg-green-200">
                                                                <i class="fas fa-file-archive text-4xl text-green-500"></i>
                                                            </div>
                                                        @elseif (str_starts_with($attachment->type, 'video/'))
                                                            <div class="flex items-center justify-center h-32 bg-blue-200">
                                                                <i class="fas fa-file-video text-4xl text-blue-500"></i>
                                                            </div>
                                                        @elseif (str_starts_with($attachment->type, 'audio/'))
                                                            <div class="flex items-center justify-center h-32 bg-yellow-200">
                                                                <i class="fas fa-file-audio text-4xl text-yellow-500"></i>
                                                            </div>
                                                        @else
                                                            <div class="flex items-center justify-center h-32 bg-gray-300">
                                                                <i class="fas fa-file text-4xl text-gray-500"></i>
                                                            </div>
                                                        @endif
                                                        <a href="{{ Storage::url($attachment->path) }}" class="absolute top-0 btn btn-xs btn-circle btn-ghost right-0 mt-1 mr-1 bg-gray-500 text-white text-xs px-2 py-1">
                                                            <i class="fas fa-download"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                                <div class="text-[10px] mt-1 text-blue-500">
                                    {{ $message->time }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="flex flex-col g">
                    @if (count($attachments) > 0)
                        <div class="flex w-full bg-gray-100 p-2 pt-3">
                            @foreach($attachments as $attachment)
                                <div
                                    class="flex relative flex-col items-center justify-center w-16 h-16 bg-blue-200 rounded-md mr-2">
                                    @if (in_array($attachment->getMimeType(), ['image/jpeg', 'image/png']))
                                        <img src="{{ $attachment->temporaryUrl() }}" alt="Attachment"
                                             class="w-16 h-16 object-cover rounded-md">
                                    @elseif ($attachment->getMimeType() == 'image/svg+xml')
                                        <i class="fas fa-file-image text-4xl text-gray-500"></i>
                                    @elseif ($attachment->getMimeType() == 'application/zip')
                                        <i class="fas fa-file-archive text-4xl text-gray-500"></i>
                                    @else
                                        <i class="fas fa-file text-4xl text-gray-500"></i>
                                    @endif
                                    <!-- Displaying the first five characters of the file name -->
                                    <span class="text-xs mt-1">
                                    {{ substr($attachment->getClientOriginalName(), 0, 5) }}{{ strlen($attachment->getClientOriginalName()) > 5 ? '...' : '' }}
                                </span>
                                    <button wire:click="removeAttachment('{{ $attachment->getClientOriginalName() }}')"
                                            class="absolute btn-warning btn btn-xs btn-circle top-0 right-1 text-red-500 hover:text-red-700 -mt-2 -mr-3">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            @endforeach

                        </div>
                    @endif
                    <div class="text-red-500 bg-gray-100 text-xs px-4">
                        @error('attachments.*') <span class="error m-1">{{ $message }}</span> @enderror
                        @error('newMessage') <span class="error m-1">{{ $message }}</span> @enderror
                    </div>
                    <div class="bg-gray-100 px-2 py-4 relative flex items-center">
                        <label class="w-full">
                            <input wire:model.live="newMessage" wire:keydown.enter="sendMessage"
                                   class="message-input"
                                   type="text" placeholder="Type your message...">
                        </label>
                        <!-- Hidden file input -->
                        <input wire:model.live="attachments" type="file" id="fileInput" multiple style="display: none;">
                        <!-- Clip icon for opening file dialog -->
                        <button
                            class="btn absolute left-3 btn-ghost ring-1 ring-primary text-primary top[50%] transform[-50%] btn-sm btn-circle ml-2"
                            onclick="document.getElementById('fileInput').click();">
                            <i class="fas fa-paperclip"></i>
                        </button>
                        <!-- Send message button -->
                        <button wire:click="sendMessage"
                                class="btn absolute right-3 btn-primary top[50%] transform[-50%] btn-sm btn-circle mr-2">
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
