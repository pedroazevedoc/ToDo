<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Task;

class TaskController extends Controller
{
    //
    public function index(Request $request) {
        return view('tasks');
    }

    public function create(Request $request) {
        $categories = Category::all();
        $data['categories'] = $categories;

        return view('tasks.create', $data);
    }

    public function create_action(Request $request) {
        $task = $request->only(['title', 'due_date', 'category_id', 'description']);
        $task['user_id'] = 1;

        $dbTask = Task::create($task);
        return redirect(route('home'));
    }

    public function edit(Request $request) {
        $id = $request->id;

        $task = Task::find($id);
        if (!$task) {
            return redirect(route('home'));
        }

        $categories = Category::all();
        $data['categories'] = $categories;

        $data['task'] = $task;

        return view('tasks.edit', $data);
    }

    public function edit_action(Request $request) {
        // "id" => "1"
        // "is_done" => "1"
        // "title" => "Minha primeira tarefa ID: 1"
        // "due_date" => "2000-12-18T15:29:55"
        // "category_id" => "5"
        // "description" => "Vel id nesciunt vitae est maiores."

        $request_data = $request->only('title', 'due_date', 'category_id', 'description');

        $request_data['is_done'] = $request->is_done ? true : false;

        $task = Task::find($request->id);
        if (!$task) {
            return 'Erro de task não existente';
        }
        $task->update($request_data);
        $task->save();
        return redirect(route('home'));
    }

    // atualiza a tarefa ao clicar no check na listagem
    public function update(Request $request){
        $task = Task::findOrFail($request->taskId);
        $task->is_done = $request->status;
        $task->save();
        return ['success' => true];
    }

    public function delete(Request $request) {
        $id = $request->id;

        $task = Task::find($id);
        if ($task) {
            $task->delete();
        }
        return redirect(route('home'));
    }
}
