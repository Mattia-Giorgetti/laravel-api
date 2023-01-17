<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Type;
use App\Models\Technology;

class NavigationController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        $types = Type::all();
        $technologies = Technology::all();
        return view('guest.projects.index', compact('projects'));
    }
}
