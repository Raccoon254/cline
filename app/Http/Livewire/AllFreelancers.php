<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\View\View;
use Livewire\Component;

class AllFreelancers extends Component
{
    public string $search = '';
    public function render(): View
    {
        return view('livewire.all-freelancers', [
            'freelancers' => User::where('role', 'user')
                ->where(function ($query) {
                    $query->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('email', 'like', '%' . $this->search . '%')
                        ->orWhere('phone_number', 'like', '%' . $this->search . '%');
                })
                ->orderBy("name", "asc")
                ->paginate(20),
        ]);
    }
}
