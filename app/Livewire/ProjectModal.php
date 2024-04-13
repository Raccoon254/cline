<?php

namespace App\Livewire;

use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ProjectModal extends Component
{
    public string $name;
    public string $description;
    public $end_date;
    public int $client_id;
    public int $freelancer_id;
    public int $price;

    public $clients;
    public $freelancers;
    public string $role;
    public string $searchTerm = '';

    public function mount(): void
    {
        $this->clients = User::where('role', 'client')->get();
        $this->freelancers = User::where('role', 'freelancer')->get();
        $this->role = Auth::user()->role ?? "user";
    }

    public function createProject(): void
    {
        $validatedData = $this->validate([
            'name' => 'required',
            'description' => 'required',
            'end_date' => 'required|date',
            'client_id' => 'required',
            'freelancer_id' => 'required',
            'price' => 'required|numeric',
        ]);

        $start_date = now();
        $validatedData['start_date'] = $start_date;
        //change key freelancer_id to user_id
        $validatedData['user_id'] = $validatedData['freelancer_id'];
        dd($validatedData);

        Project::create($validatedData);

        $this->reset(['name', 'description', 'end_date', 'client_id', 'freelancer_id', 'price']);
    }

    public function render(): \Illuminate\View\View
    {
        $role = Auth::user()->role ?? "user";
        return view('livewire.project-modal')->with('role', $role);
    }
}
