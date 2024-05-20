<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Task;
use App\Models\Project;

class TaskModal extends Component
{
    public $title = '';
    public $description = '';
    public $due_date = '';
    public $priority = '';
    public $status = '';
    public $estimated_duration = '';
    public $project_id = '';

    public function mount(): void
    {
        $this->createTask();
    }

    public function createTask(): void
    {
        $validatedData = $this->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'due_date' => 'required|date',
            'priority' => 'required',
            'status' => 'required',
            'estimated_duration' => 'required',
            'project_id' => 'required|exists:projects,id',
        ]);

        // get the project
        $project = Project::find($this->project_id);
        $validatedData['project_id'] = $project->id;

        Task::create($validatedData);

        // Reset the public properties
        $this->reset(['title', 'description', 'due_date', 'priority', 'status', 'estimated_duration', 'project_id']);

        // Maybe notify the user who created the task

        session()->flash('success', 'Task created successfully.');

        // Redirect to the tasks.index route
        $this->redirectRoute('tasks.index');
    }

    public function render()
    {
        $tasks = Task::all();
        $projects = Project::all();
        return view('livewire.task-modal', compact('tasks', 'projects'));
    }
}
