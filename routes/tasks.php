<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::middleware(["auth", "role:client"])->group(function () {
    Route::resource('tasks', [TaskController::class]);
});
