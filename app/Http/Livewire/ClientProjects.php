<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class ClientProjects extends Component
{
    use WithPagination;
    public string $searchTerm = "";

    public function render(): View
    {
        $currentClient = Auth::user()->client;
        return view('client.projects',
            [
                'projects' => $currentClient->projects()->where('name', 'like', '%' . $this->searchTerm . '%')->paginate(4)
            ]
        );
    }
}
