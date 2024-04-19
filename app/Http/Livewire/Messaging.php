<?php

namespace App\Http\Livewire;

use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Component;

class Messaging extends Component
{
    public $newMessage = '';
    public $messages = [];
    public $selectedRecipientId;
    public $selectedRecipient;
    public $search = '';

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
        $message = Message::create([
            'sender_id' => Auth::id(),
            'recipient_id' => $this->selectedRecipientId,
            'body' => $this->newMessage,
            'sent_at' => now(),
        ]);

        $this->messages->push($message);
        $this->newMessage = '';
    }

    public function selectRecipient($userId): void
    {
        $this->selectedRecipientId = $userId;
        $this->selectedRecipient = User::find($userId);
        $this->loadMessages();
    }

    public function render(): View
    {
        $users = User::where('name', 'like', '%' . $this->search . '%')
            ->where('id', '!=', Auth::id())
            ->get();

        return view('livewire.messaging', [
            'users' => $users,
        ]);
    }
}
