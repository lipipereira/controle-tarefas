<?php

namespace App\Http\Controllers;

use App\Mail\NewTaskMail;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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
        $id = Auth::user()->id;
        $nome = Auth::user()->name;
        $email = Auth::user()->email;

        return "ID: $id | Nome: $nome | Email: $email";

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

        $task = Task::create($request->all());
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        //
    }
}
