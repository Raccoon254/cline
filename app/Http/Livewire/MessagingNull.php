<?php

namespace App\Http\Livewire;

use App\Models\Message;
use App\Models\MessageAttachment;
use App\Models\User;
use App\Notifications\NewMessageNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class MessagingNull extends Component
{
    use WithFileUploads;
    public string $newMessage = '';
    public mixed $messages = [];
    public mixed $selectedRecipientId;
    public mixed $selectedRecipient;
    public string $search = '';
    public array $attachments = [];

    protected $listeners = ['newMessage', 'loadMessages', 'selectRecipient', 'updatedSearch'];

    public function mount(): void
    {
        $users = User::where('id', '!=', Auth::id())->get();
        $this->selectRecipient($users->first()->id);
    }

    public function loadMessages(): void
    {
        $this->selectedRecipient = User::find($this->selectedRecipientId);
        $this->messages = Message::where(function ($query) {
            $query->where('sender_id', Auth::id())
                ->where('recipient_id', $this->selectedRecipientId);
        })->orWhere(function ($query) {
            $query->where('sender_id', $this->selectedRecipientId)
                ->where('recipient_id', Auth::id());
        })->orderBy('sent_at', 'asc')->get();
    }

    public function sendMessage(): void
    {
        //validate new message
        $this->validate([
            'newMessage' => 'required',
        ]);

        if ($this->attachments) {
            //total storage size of attachments must not exceed 10MB
            // validate attachments
            $this->validate([
                'attachments.*' => 'max:10240', //10MB
            ]);
        }

        $message = Message::create([
            'sender_id' => Auth::id(),
            'recipient_id' => $this->selectedRecipientId,
            'body' => $this->newMessage,
            'sent_at' => now(),
        ]);

        if ($this->attachments) {
            foreach ($this->attachments as $attachment) {
                $path = $attachment->store('attachments', 'public');
                $type = $attachment->getMimeType();
                MessageAttachment::create([
                    'message_id' => $message->id,
                    'path' => $path,
                    'type' => $type,
                ]);
            }
        }

        $this->messages->push($message);
        $this->newMessage = '';
        $recipient = User::find($this->selectedRecipientId);
        $recipient->notify(new NewMessageNotification($message));
    }

    public function selectRecipient($userId): void
    {
        $this->selectedRecipientId = $userId;
        $this->selectedRecipient = User::find($userId);
        $this->loadMessages();

        // get all unread messages and mark them as read
        $unreadMessages = Message::where('recipient_id', Auth::id())
            ->where('sender_id', $this->selectedRecipientId)
            ->where('is_read', false)
            ->get();

        foreach ($unreadMessages as $message) {
            $message->is_read = true;
            $message->read_at = now();
            $message->save();
        }
    }
    public function render(): View
    {
        $users = User::where('name', 'like', '%' . $this->search . '%')
            ->where('id', '!=', Auth::id())
            ->orderBy('name')
            ->get()
            ->sortByDesc(function ($user) {
                $lastMessage = Message::where(function ($query) use ($user) {
                    $query->where('sender_id', $user->id)
                        ->orWhere('recipient_id', $user->id);
                })->orderBy('sent_at', 'desc')->first();

                return $lastMessage ? $lastMessage->sent_at : now()->subYears(100);
            });

        return view('livewire.messaging', [
            'users' => $users,
        ]);
    }
}
