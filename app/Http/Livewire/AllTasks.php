<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Task;

class AllTasks extends Component
{
    public $search = '';

    public function render()
    {

        // Filtering tasks according to projects linked to the client
        $taskIds = auth()->user()->client->projects()->with(['tasks' => function ($query) {
            $query->where('title', 'like', '%' . $this->search . '%');
        }])->get()->pluck('tasks.*.id')->collapse()->toArray();

        $tasks = Task::whereIn('id', $taskIds)->paginate(10);

        return view('livewire.all-tasks', [
            'tasks' => $tasks,
        ]);
    }
}
