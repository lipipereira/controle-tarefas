<?php

namespace App\Http\Controllers;

use App\Exports\TasksExport;
use App\Mail\NewTaskMail;
use App\Models\Task;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::where('user_id', Auth::user()->id)->paginate(8);
        return view('task.index', ['tasks' => $tasks]);

        /*
        if (Auth::check()) {
            $id = Auth::user()->id;
            $nome = Auth::user()->name;
            $email = Auth::user()->email;
            return "ID: $id | Nome: $nome | Email: $email";
        } else {
            return 'Você não esta logado';
        }
        */

        /*
        if (auth()->check()) {
            $id = auth()->user()->id;
            $nome = auth()->user()->name;
            $email = auth()->user()->email;
            return "ID: $id | Nome: $nome | Email: $email";
        } else {
            return 'Você não esta logado';
        }
        */
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('task.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'task' => [
                'required',
                'min:5',
                'max:50'
            ],
            'date_limit_completion' => [
                'required'
            ]
        ];

        $feedback = [
            'required' => 'O :attribute é obriatório',
            'task.min' => 'Minimo de caracteres é de 5',
            'task.max' => 'Máximo de caracteres é de 5'
        ];
        $request->validate($rules, $feedback);

        $data = $request->all();
        $data['user_id'] = Auth::user()->id;

        $task = Task::create($data);
        $recipient = Auth::user()->email;

        Mail::to($recipient)->send(new  NewTaskMail($task));
        return redirect()->route('task.show', ['task' => $task->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return view('task.show', ['task' => $task]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        $user_id = Auth::user()->id;
        if ($task->id == $user_id) {
            return view('task.edit', ['task' => $task]);
        }
        return view('access-denied');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $rules = [
            'task' => [
                'required',
                'min:5',
                'max:50'
            ],
            'date_limit_completion' => [
                'required'
            ]
        ];

        $feedback = [
            'required' => 'O :attribute é obriatório',
            'task.min' => 'Minimo de caracteres é de 5',
            'task.max' => 'Máximo de caracteres é de 5'
        ];
        $request->validate($rules, $feedback);

        $user_id = Auth::user()->id;
        if ($task->id == $user_id) {
            $task->update($request->all());
            return redirect()->route('task.index');
        }
        return view('access-denied');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        if (!$task->id == Auth::user()->id) {
            return view('access-denied');
        }

        $task->delete();
        return redirect()->route('task.index');
    }

    public function export($extension)
    {
        if (in_array($extension, ['xlsx', 'csv', 'pdf'])) {
            return Excel::download(new TasksExport, 'lista_de_tarefas.' . $extension);
        }
        return redirect()->route('task.index');
    }

    public function exportPdf()
    {
        $tasks = Auth::user()->tasks()->get();
        $pdf = Pdf::loadView('task.pdf', ['tasks' => $tasks]);
        // Tipo de papel: a4, letter
        // Orientação: landscape(paisagem), portrait(retrato)
        $pdf->setPaper('a4', 'landscape');
        //return $pdf->download('lista_de_tarefas.pdf');
        return $pdf->stream('lista_de_tarefas.pdf');
    }
}
