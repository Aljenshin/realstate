<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): RedirectResponse
    {
        return redirect('/?auth=register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:users,name'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            // Allow longer passwords for better security
            'password' => ['required', 'string', 'min:8', 'max:64', 'confirmed'],
        ], [
            'name.unique' => 'This user name already exist',
            'email.unique' => 'This user name already exist',
            'password.max' => 'Password must be at most 64 characters',
            'password.min' => 'Password must be at least 8 characters',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        // Redirect to home after registration
        return redirect('/');
    }
}
