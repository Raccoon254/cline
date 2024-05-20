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
        $this->projects = Project::where('user_id', auth()->id())->get();
        $this->title = $this->task->title;
        $this->description = $this->task->description;
        $this->due_date = $this->task->due_date;
        $this->priority = $this->task->priority;
        $this->status = $this->task->status;
        $this->estimated_duration = $this->task->estimated_duration;
        $this->project_id = $this->task->project_id;
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

        $this->task->update([
            'title' => $this->title,
            'description' => $this->description,
            'due_date' => $this->due_date,
            'priority' => $this->priority,
            'status' => $this->status,
            'estimated_duration' => $this->estimated_duration,
            'project_id' => $this->project_id,
        ]);

        $this->task->save();

        session()->flash('message', 'Task updated successfully.');
        // Redirect to the tasks.index route
        $this->redirectRoute('tasks.index');
    }

    public function render()
    {
        return view('livewire.task-edit', [
            'task' => $this->task,
            'projects' => $this->projects,
        ]);
    }
}
