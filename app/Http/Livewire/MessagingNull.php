<?php

namespace App\Http\Livewire;

use App\Models\Message;
use App\Models\MessageAttachment;
use App\Models\User;
use App\Notifications\NewMessageNotification;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class MessagingNull extends Component
{
    use WithFileUploads;
    public string $newMessage = '';
    public Collection $messages;
    public mixed $selectedRecipientId;
    public mixed $selectedRecipient;
    public string $search = '';
    public array $attachments = [];

    protected $listeners = ['newMessage', 'loadMessages', 'selectRecipient', 'updatedSearch'];

    public function mount(): void
    {
        $user = User::where('id', '!=', Auth::id())->first();
        if ($user) {
            $this->selectRecipient($user->id);
        } else {
            // Handle the case where no other users are found
            session()->flash('error', 'No users available for messaging.');
        }
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
        if (empty($this->newMessage) && empty($this->attachments)) {
            return;
        }

        $message = Message::create([
            'sender_id' => Auth::id(),
            'recipient_id' => $this->selectedRecipientId,
            'body' => $this->newMessage,
            'sent_at' => now(),
        ]);

        if ($this->attachments) {
            $totalSize = array_reduce($this->attachments, function ($carry, $attachment) {
                return $carry + $attachment->getSize();
            }, 0);

            if ($totalSize > 10240000) { // 10MB
                $this->addError('attachments', 'Total attachment size should not exceed 10MB.');
                $message->delete(); // Delete the message since attachments exceeded the limit
                return;
            }

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

        $this->loadMessages();
        $this->newMessage = '';
        $this->attachments = [];
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
