<?php

namespace App\Http\Controllers;

use App\Notifications\NewProjectNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $role = Auth::user()->role ?? "user";
        $projects = Project::all();

        return view('projects.index', compact('projects', 'role'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $clients = User::where('role', 'client')->get();
        $freelancers = User::where('role', 'user')->get();
        $role = Auth::user()->role ?? "user";

        return view('projects.create', compact('clients', 'freelancers', 'role'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        if (Auth::user()->role === 'user') {
            $request->merge(['user_id' => Auth::user()->id]);
        } else {
            $request->merge(['client_id' => Auth::user()->id]);
        }

        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'end_date' => 'required|date',
            'client_id' => 'required',
            'user_id' => 'required',
            'price' => 'required|numeric',
        ]);

        //get client with user id as client id
        $client = User::find($validatedData['client_id']);
        $validatedData['client_id'] = $client->client->id;

        $start_date = now();
        $validatedData['start_date'] = $start_date;

        $project = Project::create($validatedData);

        // //Send a notification to both the client and the freelancer
        // $client->notify(new NewProjectNotification($project, Auth::user()));
        // $project->user->notify(new NewProjectNotification($project, Auth::user()));

        return redirect()->route('projects.index')->with('success', 'Project created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $project = Project::findOrFail($id);
        return view("projects.show")->with("project", $project);
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
