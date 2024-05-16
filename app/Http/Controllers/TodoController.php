<?php

namespace App\Http\Controllers;

use App\Models\Todolist;
use domain\facades\TodoFacade;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TodoController extends ParentController

{

    public function index()
    {

        return Inertia::render('Todo/index');
    }
    public function store(Request $request)
    {
        return TodoFacade::store($request->all());
    }
    public function list()
    {
        $tasks = TodoFacade::all();
        return response()->json($tasks);
    }

    public function get($task_id)
    {
        $tasks = TodoFacade::get($task_id);
        return response()->json($tasks);
    }

    public function delete($task_id)
    {
        return TodoFacade::delete($task_id);
    }

    public function done($task_id)
    {
        TodoFacade::done($task_id);
        return response()->json(['message' => 'Task updated successfully']);
    }

    public function edit(Request $request)
    {
        $response['task'] = TodoFacade::get($request['task_id']);
        return view('pages.todo.edit')->with($response);
    }

    public function update(Request $request, $task_id)
    {
        return TodoFacade::update($request->all(), $task_id);
    }



    // sub tasks section



    public function sub($task_id)
    {
        $response['task'] = TodoFacade::get($task_id);
        $response['sub_tasks'] = TodoFacade::getSubTaskByTask($task_id);

        return view('pages.todo.sub')->with($response);
    }

    public function subStore(Request $request)
    {

        TodoFacade::subStore($request->all());
        return redirect()->back();
    }
}
