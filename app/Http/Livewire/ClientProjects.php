<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Component;

class ClientProjects extends Component
{
    public User $currentClient;
    public string $searchTerm = "";
    public function mount(): void
    {
        $this->currentClient = Auth::user() ?? new User();
    }
    public function render(): View
    {
        return view('livewire.client-projects',
            [
                'projects' => $this->currentClient->projects()->where('title', 'like', '%' . $this->searchTerm . '%')->get()
            ]
        );
    }
}
