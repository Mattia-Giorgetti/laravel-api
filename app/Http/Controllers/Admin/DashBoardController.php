<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashBoardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }
}
