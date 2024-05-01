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
use Illuminate\Database\Eloquent\Collection;

class Messaging extends Component
{
    use WithFileUploads;

    public string $newMessage = '';
    public Collection $messages;
    public mixed $selectedRecipientId;
    public mixed $selectedRecipient;
    public string $search = '';
    public array $attachments = [];

    public function mount(User $user = null): void
    {
        $this->selectRecipient($user->id ?? User::where('id', '!=', Auth::id())->first()->id);
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

        $this->dispatch('messagesLoaded');
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

        $this->newMessage = '';
        $this->attachments = [];
        $this->reset('newMessage', 'attachments');

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

        // Delay the notification for 5 minutes
        $recipient = User::find($this->selectedRecipientId);
        $recipient->notify((new NewMessageNotification($message))->delay(now()->addMinutes(5)));
    }

    public function getUnreadMessagesCount($senderId, $recipientId): int
    {
        return Message::where('sender_id', $senderId)
            ->where('recipient_id', $recipientId)
            ->where('is_read', false)
            ->count();
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

        $this->dispatch('messagesLoaded');
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

        $this->dispatch('messagesLoaded');

        return view('livewire.messaging', [
            'users' => $users,
        ]);
    }
}
