<?php

namespace App\Http\Livewire;

use App\Models\Message;
use App\Models\User;
use App\Notifications\NewMessageNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithFileUploads;

class Messaging extends Component
{
    use WithFileUploads;

    public string $newMessage = '';
    public mixed $messages = [];
    public mixed $selectedRecipientId;
    public mixed $selectedRecipient;
    public string $search = '';
    public mixed $attachment = null;

    protected $listeners = ['newMessage', 'loadMessages', 'selectRecipient', 'updatedSearch'];

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
    }

    public function sendMessage(): void
    {
        $attachmentPath = null;
        $attachmentType = null;

        if ($this->attachment) {
            $attachmentPath = $this->attachment->store('attachments', 'public');
            $attachmentType = $this->attachment->getMimeType();

            //dd($attachmentPath, $attachmentType);
        }

        $message = Message::create([
            'sender_id' => Auth::id(),
            'recipient_id' => $this->selectedRecipientId,
            'body' => $this->newMessage,
            'sent_at' => now(),
            'attachment_path' => $attachmentPath,
            'attachment_type' => $attachmentType
        ]);

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
