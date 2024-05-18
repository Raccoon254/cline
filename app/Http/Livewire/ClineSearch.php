<?php

namespace App\Http\Livewire;

use App\Models\Invoice;
use App\Models\Message;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\View\View;
use Livewire\Component;
use Illuminate\Support\Collection;

class ClineSearch extends Component
{
    public string $search = '';
    public Collection $searchResults;

    public function mount(): void
    {
        $this->searchResults = collect();
    }

    /*
     * This method is used to search for EVERYTHING in the database
     * that matches the search query.
     */
    public function search(): void
    {
        $searchResults = collect();
        //get all models
        $models = [User::class, Invoice::class, Project::class, Task::class, Message::class, Invoice::class];
        foreach ($models as $model) {
            $searchResults = $searchResults->concat($model::where('name', 'like', '%' . $this->search . '%')->get());
        }
        //map the results to have a name
        $this->searchResults = $searchResults->map(function ($result) {
            $result->name = $result->name ?? $result->title ?? $result->description;
            return $result;
        });
    }

    public function render(): View
    {
        return view('search.index',
            [
                'searchResults' => $this->searchResults,
            ]
        );
    }
}
