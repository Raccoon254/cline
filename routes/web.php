<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ThemeController;
use App\Http\Livewire\AllUsers;
use App\Http\Livewire\Messaging;
use App\Http\Livewire\MessagingNull;
use App\Http\Livewire\UserCompleteProfileForm;
use Illuminate\Support\Facades\Auth;
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
})->name("welcome");



Route::get("/users", AllUsers::class)->name("welcome");

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
        $freelancers = App\Models\User::where("role", "user")->get();
        return view("client.dashboard")->with("freelancers", $freelancers);
    })->name("client.dashboard");
});

Route::get("/client/freelancers/{freelancer}", function ($freelancer) {
    $freelancer = App\Models\User::find($freelancer);
    return view("client.freelancers.show")->with("freelancer", $freelancer);
})->name("client.freelancers.show");

Route::group(["middleware" => ["auth", "role:user", "complete_profile"]], function () {
    Route::get("/user/dashboard", function () {
        $clients = App\Models\User::where("role", "client")->get();
        return view("user.dashboard")->with("clients", $clients);
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

Route::get('/user/profile/complete', UserCompleteProfileForm::class)->name('user.profile.complete')->middleware('auth');

Route::get('/inbox', MessagingNull::class)->name('inbox')->middleware('auth');
Route::get('/inbox/{user?}', Messaging::class)->name('messages.create')->middleware('auth');

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
require __DIR__ . "/tasks.php";
