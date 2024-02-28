<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'phone_number' => ['required', 'string', 'max:10', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $phone_number_validated = $this->validateNumber($request->phone_number);
        if (!$phone_number_validated) {
            return redirect()->back()->with('error', 'Invalid phone number');
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $phone_number_validated,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }

    private function validateNumber(mixed $phone_number): int|bool
    {
        $phone_number = str_replace(['(', ')', '-', ' '], '', $phone_number);
        if (strlen($phone_number) != 10) {
            return false;
        }

        //if the number does not start with 0
        if (substr($phone_number, 0, 1) != 0) {
            return false;
        }

        /**
         *Remove the 0 at the beginning and replace it with country code
         *This is done to facilitate standardization of phone numbers
         */
        $country_code = env('COUNTRY_CODE', '0');
        return $country_code . substr($phone_number, 1);
    }

    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }
}
