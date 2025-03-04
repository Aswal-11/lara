<?php

use App\Http\Controllers\TaskController;

use Illuminate\Support\Facades\Route;

Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');

Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');

Route::post('/tasks/{id}/toggleComplete', [TaskController::class, 'toggleComplete'])->name('tasks.toggleComplete');

Route::delete('/tasks/{id}', [TaskController::class, 'destroy'])->name('tasks.destroy');
