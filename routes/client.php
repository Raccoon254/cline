<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ClientProjectController;

Route::middleware(["auth", "role:client"])->group(function () {
    Route::get("/client/projects", [ClientProjectController::class, "index"])->name("client.projects.index");
    Route::get("/client/projects/create", [ClientProjectController::class, "create"])->name("client.projects.create");
    Route::post("/client/projects", [ClientProjectController::class, "store"])->name("client.projects.store");
    Route::get("/client/projects/{id}", [ClientProjectController::class, "show"])->name("client.projects.show");
    Route::get("/client/projects/{id}/edit", [ClientProjectController::class, "edit"])->name("client.projects.edit");
    Route::put("/client/projects/{id}", [ClientProjectController::class, "update"])->name("client.projects.update");
    Route::delete("/client/projects/{id}", [ClientProjectController::class, "destroy"])->name("client.projects.destroy");
});

//clients.show
Route::get("/clients/{id}", [ClientProjectController::class, "showClient"])->name("clients.show");
