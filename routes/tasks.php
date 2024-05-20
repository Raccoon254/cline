<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Livewire\TaskModal;
use App\Http\Livewire\AllTasks;
use App\Http\Livewire\TaskEdit;

Route::middleware(["auth", "role:client"])->group(function () {
    // Route::resource('tasks', TaskController::class);
    Route::get("tasks", AllTasks::class)->name('tasks.index');;
    Route::get('tasks/create', TaskModal::class)->name('tasks.create');
    Route::post("tasks", [TaskController::class, "store"])->name("tasks.store");
    Route::get("tasks/{id}", [TaskController::class, "show"])->name("tasks.show");
    Route::get("tasks/{id}/edit", TaskEdit::class)->name("tasks.edit");
    Route::put("tasks/{id}", [TaskController::class, "update"])->name("tasks.update");
    Route::delete("tasks/{id}", [TaskController::class, "destroy"])->name("tasks.destroy");
});
