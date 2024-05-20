<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Task;
use App\Models\Project;

class TaskEdit extends Component
{
    public $task;
    public $projects;

    public $title = '';
    public $description = '';
    public $due_date = '';
    public $priority = '';
    public $status = '';
    public $estimated_duration = '';
    public $project_id = '';

    public function mount($id)
    {
        $this->task = Task::findOrFail($id);
        $this->projects = Project::all();
    }

    public function save()
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

        $this->task->save();

        session()->flash('message', 'Task updated successfully.');
    }

    public function render()
    {
        return view('livewire.task-edit', [
            'task' => $this->task,
            'projects' => $this->projects,
        ]);
    }
}
