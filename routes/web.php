<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::resource('task', TaskController::class);
Route::resource('project', ProjectController::class);
Route::post('ordering', [TaskController::class, 'ordering'])->name('task.ordering');
Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
Route::get('/', function(){
    return view('welcome');
})->name('home');
