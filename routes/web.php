<?php

use App\Http\Controllers\TaskController;
use App\Mail\MessageTestMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::middleware('verified')
    ->get('task/export/{extension}', [TaskController::class, 'export'])->name('task.export');
Route::middleware('verified')
    ->get('task/exportPdf', [TaskController::class, 'exportPdf'])->name('task.exportPdf');
Route::middleware('verified')
    ->resource('/task', TaskController::class);

/*
Route::get('/message-test', function () {
    //return new MessageTestMail();

    Mail::to('felipe01.sth@gmail.com')->send(new MessageTestMail());
    return 'E-mail enviado com sucesso!';
});
*/

/*
Route::middleware('verified')
    ->get('/home', [App\Http\Controllers\HomeController::class, 'index'])
    ->name('home');
*/
