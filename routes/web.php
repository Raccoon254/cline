<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ThemeController;
use App\Livewire\Messaging;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
})->name("welcome");

Route::get("/dashboard", function () {
    $role = Auth::user()->role ?? "user";
    if ($role === "admin") {
        return redirect()->route("admin.dashboard");
    } elseif ($role === "user") {
        return redirect()->route("user.dashboard");
    } elseif ($role === "client") {
        return redirect()->route("client.dashboard");
    } else {
        return redirect()->route("unauthorized");
    }
})
    ->middleware(["auth", "verified"])
    ->name("dashboard");

Route::group(["middleware" => ["auth", "role:admin"]], function () {
    Route::get("/admin/dashboard", function () {
        return view("admin.dashboard");
    })->name("admin.dashboard");
});

Route::group(["middleware" => ["auth", "role:client"]], function () {
    Route::get("/client/dashboard", function () {
        return view("client.dashboard");
    })->name("client.dashboard");
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

Route::get('/inbox', Messaging::class)->name('inbox');

Route::get("/unauthorized", function () {
    return view("static/unauthorized");
})->name("unauthorized");

Route::get("/about", function () {
    return view("static/about");
})->name("about");

Route::post("/set-theme", [ThemeController::class, "setTheme"])->name(
    "set-theme"
);
Route::get("/get-theme", [ThemeController::class, "getTheme"])->name(
    "get-theme"
);

require __DIR__ . "/auth.php";
require __DIR__ . "/projects.php";
require __DIR__ . "/client.php";
