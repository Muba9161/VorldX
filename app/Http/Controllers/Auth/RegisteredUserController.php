<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class RegisteredUserController extends Controller
{
    // This method will show the registration form
    public function create()
    {
        // If the user is already logged in, redirect to the dashboard
        if (auth()->check()) {
            return redirect()->route('dashboard'); // Ensure 'dashboard' is the correct route name
        }

        // Show the registration form to unauthenticated users
        return view('auth.register');
    }

    // This method will handle the registration logic
    public function store(Request $request)
    {
        // Validate the user input
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
            'option' => ['required', 'in:entity,individual'],  // Ensure 'option' is validated
        ]);

        // \Log::info('Validated Option:', ['option' => $validated['option']]);

        // Create the user in the database, including the 'option' field
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'option' => $validated['option'],  // Store the selected option ('entity' or 'individual')
        ]);

        // Log the user in automatically after registration
        auth()->login($user);

        // Redirect the user to the dashboard (or home, depending on your app's flow)
        return redirect()->route('dashboard'); // Adjust this route if needed
    }
}
