<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class AllUsers extends Component
{
    use WithPagination;

    public string $search = "";

    public function render(): View
    {
        return view('livewire.all-users',
            [
                "users" => User::where("name", "like", "%$this->search%")->orderBy("name")->paginate(10)
            ]
        );
    }
}
