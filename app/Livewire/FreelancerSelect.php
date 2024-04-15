<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\View\View;
use Livewire\Component;

class FreelancerSelect extends Component
{
    public $searchTerm = '';
    public $selectedFreelancer;


    public function selectFreelancer($freelancerId): void
    {
        $this->selectedFreelancer = $freelancerId;
    }

    public function render(): View
    {
        return view('livewire.freelancer-select',[
            'freelancers' => User::where('role', 'user')
                ->where('name', 'like', '%'.$this->searchTerm.'%')
                ->take(6)
                ->get()
        ]);
    }
}
