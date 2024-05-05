<?php

namespace App\Http\Livewire;

use App\Models\Invoice;
use App\Models\Project;
use App\Models\User;
use Illuminate\View\View;
use Livewire\Component;

class ClineSearch extends Component
{
    public string $search = '';
    public mixed $searchResults;

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
        $this->searchResults = collect();
        //get all models
        $models = [User::class, Invoice::class, Project::class];
        foreach ($models as $model) {
            $this->searchResults = $this->searchResults->merge($model::search($this->search)->get());
        }
        //map the results to have a name
        $this->searchResults = $this->searchResults->map(function ($result) {
            $result->name = $result->name ?? $result->title ?? $result->description;
            return $result;
        });
    }

    public function render(): View
    {
        return view('search.index');
    }
}
