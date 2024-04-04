<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Termwind\Components\Dd;

class ClientProjectController extends Controller
{
    public function index()
    {
        $projects = auth()->user()->projects;
        dd($projects);
        return view("client.projects.index")->with("projects", $projects);
    }
}
