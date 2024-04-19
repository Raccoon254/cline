<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class AllClients extends Component
{
    public $search;

    public function mount()
    {
    }

    public function render()
    {
        return view('livewire.all-clients',
            [
                'clients' => User::where('role', 'client')
                    ->where('name', 'like', '%' . $this->search . '%')
                    ->get()
            ]
        );
    }
}
