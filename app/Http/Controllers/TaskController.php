<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
