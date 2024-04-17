<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\View\View;
use Livewire\Component;

class FreelancerSelect extends Component
{
    public string $searchTerm = '';
    public int $selectedFreelancer;
    public string $selectedFreelancerName;

    public function selectFreelancer($freelancerId): void
    {
        $this->selectedFreelancer = $freelancerId;
        $this->selectedFreelancerName = User::find($freelancerId)->name;
    }

    public function render(): View
    {
        return view('livewire.freelancer-select',[
            'freelancers' => User::where('role', 'user')
                ->where('name', 'like', '%'.$this->searchTerm.'%')
                ->take(20)
                ->get()
        ]);
    }
}
