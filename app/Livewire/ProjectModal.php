<?php

namespace App\Livewire;

use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ProjectModal extends Component
{
    public string $name;
    public string $description;
    public $end_date;
    public $client_id;
    public $freelancer_id;
    public $price;

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

        Project::create($validatedData);

        $this->reset(['name', 'description', 'end_date', 'client_id', 'freelancer_id', 'price']);
    }

    public function render(): \Illuminate\View\View
    {
        $role = Auth::user()->role ?? "user";
        return view('livewire.project-modal')->with('role', $role);
    }
}
