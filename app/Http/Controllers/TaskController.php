<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\URL;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::paginate(10);

        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $projects = Project::all();
        return view('tasks.create',  compact('projects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'due_date' => 'required|date',
            'priority' => 'required',
            'status' => 'required',
            'estimated_duration' => 'required',
            'project_id' => 'required|exists:projects,id',
        ]);

        // get the project
        $project = Project::find($validatedData['project_id']);
        $validatedData['project_id'] = $project->id;

        Task::create($validatedData);

        // Maybe notify the user who created the task

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tasks = Task::findOrFail($id);
        // return view('tasks.show', compact('tasks'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        $task->status = $request->status;

        $task->save();

        return response()->json(['status' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = Task::find($id);

        if ($task) {
            $task->delete();
            session()->flash('message', 'Task deleted successfully.');

            if (URL::previous() == route('tasks.show', $id)) {
                return redirect()->route('tasks.index'); // Replace 'tasks.index' with your default route
            }

            return redirect()->back();
        }

        session()->flash('message', 'Task not found.');
        return redirect()->back();
    }
}
