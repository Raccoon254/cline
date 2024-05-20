<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Task;

class AllTasks extends Component
{
    public $search = '';

    public function render()
    {
        return view('livewire.all-tasks', [
            'tasks' => Task::with('project')
                ->where('title', 'like', '%' . $this->search . '%')
                ->paginate(10),
        ]);
    }
}
