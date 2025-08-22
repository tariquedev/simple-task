<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('task.list',[
            'tasks' => Task::orderBy('priority', 'asc')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('task.create',[
            'projects' => Project::orderBy('name', 'asc')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => "required",
            'project_id' => "required",
            'description' => "required",
        ],[
            'project_id.required' => "Project field is required"
        ]);

        $count = Task::orderBy('priority', 'desc')->first();

        $task =  new Task();
        $task->name = $request->name;
        $task->description = $request->description;
        $task->project_id = $request->project_id;
        $task->priority   = $count ? $count->priority + 1 : 1;
        $task->save();

        return redirect(route('task.index'))->with(['success' => "Task created Successfully"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        return view('task.edit',[
            'task' => $task,
            'projects' => Project::orderBy('name', 'asc')->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'name' => "required",
            'project_id' => "required",
            'description' => "required",
        ]);

        $task->update([
            'name' => $request->name,
            'description' => $request->description,
            'project_id' => $request->project_id
        ]);

        return back()->with(['success' => "Task Updated Successfully"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return back()->with(['success' => "Task Deleted Successfully"]);
    }

    public function ordering(Request $request){
        foreach ($request->task_id as $key => $value) {
            Task::find($value)->update(['priority' => $key + 1]);
        }

        return response()->json('Reorder task successfully');
    }
}
