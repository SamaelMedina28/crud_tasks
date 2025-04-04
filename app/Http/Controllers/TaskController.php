<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::orderBy('id', 'desc')->paginate(5);

        return view('inicio', compact('tasks'));

    }

    public function create()
    {
        // Logic to show the form for creating a new task

        return view('crear');
    }

    public function store( TaskRequest $request)
    {
        // Logic to store a new task

        Task::create($request->all());

        return redirect()->route('tasks.index');
    }

    public function show($id)
    {
        // Logic to display a specific task
        $task = Task::find($id);
        if (!$task) {
            return redirect()->route('tasks.index')->with('error', 'TAREA NO ENCONTRADA');
        }
        return view('mostrar', compact('task'));
    }

    public function edit($id)
    {
        $task = Task::find($id);
        if (!$task) {
            return redirect()->route('tasks.index')->with('error', 'TAREA NO ENCONTRADA');
        }
        return view('editar', compact('task'));
        // Logic to show the form for editing a specific task
    }

    public function update(TaskRequest $request, $id)
    {
        // Logic to update a specific task
        $task = Task::find($id);
        if (!$task) {
            return redirect()->route('tasks.index')->with('error', 'TAREA NO ENCONTRADA');
        }
        $task->update($request->all());
        return redirect()->route('tasks.show', $task);
    }

    public function destroy($id)
    {
        // Logic to delete a specific task
        $task = Task::find($id);
        if (!$task) {
            return redirect()->route('tasks.index')->with('error', 'TAREA NO ENCONTRADA');
        }
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'TAREA ELIMINADA CON EXITO');
    }

}
