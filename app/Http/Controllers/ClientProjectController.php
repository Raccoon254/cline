<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Termwind\Components\Dd;

class ClientProjectController extends Controller
{
    public function index(): View
    {
        $projects = auth()->user()->projects;
        return view("client.projects.index")->with("projects", $projects);
    }

    public function showClient($id): View
    {
        $client = User::findOrFail($id);
        return view("client.show")->with("client", $client);
    }
}
