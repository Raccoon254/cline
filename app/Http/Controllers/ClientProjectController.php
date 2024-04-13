<?php

namespace App\Http\Controllers;

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
}
