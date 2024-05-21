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
        //get name and description of projects
        $projects = $currentClient->projects()->where('name', 'like', '%' . $this->searchTerm . '%')
            ->orWhere('description', 'like', '%' . $this->searchTerm . '%')
            ->paginate(3);

        return view(
            'client.projects',
            [
                'projects' => $projects
            ]
        );
    }
}
