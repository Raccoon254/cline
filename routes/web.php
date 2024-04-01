<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ThemeController;
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

Route::get("/", function () {
    return view("welcome");
});

Route::get("/dashboard", function () {
    return view("dashboard");
})
    ->middleware(["auth", "verified"])
    ->name("dashboard");

Route::group(["middleware" => ["auth", "role:admin"]], function () {
    Route::get("/admin/dashboard", function () {
        return view("admin.dashboard");
    })->name("admin.dashboard");
});

Route::group(["middleware" => ["auth", "role:manager"]], function () {
    Route::get("/manager/dashboard", function () {
        return view("manager.dashboard");
    })->name("manager.dashboard");
});

Route::group(["middleware" => ["auth", "role:user"]], function () {
    Route::get("/user/dashboard", function () {
        return view("user.dashboard");
    })->name("user.dashboard");
});

Route::middleware("auth")->group(function () {
    Route::get("/profile", [ProfileController::class, "edit"])->name(
        "profile.edit"
    );
    Route::patch("/profile", [ProfileController::class, "update"])->name(
        "profile.update"
    );
    Route::delete("/profile", [ProfileController::class, "destroy"])->name(
        "profile.destroy"
    );
});

Route::get("/unauthorized", function () {
    return view("static/unauthorized");
})->name("unauthorized");

Route::post("/set-theme", [ThemeController::class, "setTheme"])->name(
    "set-theme"
);
Route::get("/get-theme", [ThemeController::class, "getTheme"])->name(
    "get-theme"
);

require __DIR__ . "/auth.php";
