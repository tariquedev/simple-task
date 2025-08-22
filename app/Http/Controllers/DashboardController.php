<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function dashboard(){
        return view('dashboard.dashboard',[
            'taskCount' => Task::count(),
            'projectCount' => Project::count()
        ]);
    }
}
