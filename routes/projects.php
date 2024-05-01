<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProjectController;

Route::middleware(["auth"])->group(function () {
    Route::get("projects", [ProjectController::class, "index"])->name("projects.index");
    Route::get("projects/create", [ProjectController::class, "create"])->name("projects.create");
    Route::post("projects", [ProjectController::class, "store"])->name("projects.store");
    Route::get("projects/{id}", [ProjectController::class, "show"])->name("projects.show");
    Route::get("projects/{id}/edit", [ProjectController::class, "edit"])->name("projects.edit");
    Route::put("projects/{id}", [ProjectController::class, "update"])->name("projects.update");
    Route::delete("projects/{id}", [ProjectController::class, "destroy"])->name("projects.destroy");
});
