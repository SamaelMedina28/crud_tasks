<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('inicio');
});
Route::resource('tasks',TaskController::class)->parameters(['tasks'=>'task'])->names('tasks');
