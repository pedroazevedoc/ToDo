<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class HomeController extends Controller
{
    //

    public function index(Request $request) {
        
        if ($request->date) {
            $filteredDate = $request->date;
        } else {
            $filteredDate = date('Y-m-d');
        }

        $carbonDate = Carbon::createFromDate($filteredDate);

        $data['date_as_string'] = $carbonDate->translatedFormat('d') . ' de ' . ucfirst($carbonDate->translatedFormat('M'));
        //voltando para o dia anterior
        $data['date_prev_button'] = $carbonDate->addDay(-1)->format('Y-m-d');
        //indo para o dia posterior
        $data['date_next_button'] = $carbonDate->addDay(2)->format('Y-m-d');

        $data['tasks'] = Task::whereDate('due_date', $filteredDate)->get();
        $data['authUser'] = Auth::user();

        $data['task_count'] = $data['tasks']->count();
        $data['undone_tasks_count'] = $data['tasks']->where('is_done', false)->count();

        return view('home', $data);
    }
}