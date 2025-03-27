<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class VaultPasswordProtection
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // If the user is authenticated and submitting the password, verify it
        if ($request->isMethod('post') && $request->has('vault_password')) {
            $user = Auth::user(); // Get logged-in user
            $vaultPassword = $request->input('vault_password'); // Get entered password

            // Check if the password matches the user's password
            if (Auth::check() && Hash::check($vaultPassword, $user->password)) {
                // Password matches, continue
                return $next($request);
            } else {
                // Password doesn't match
                return redirect()->route('login'); // Redirect to login page
            }
        }

        // Check if the user is logged in but hasn't entered the password
        if (Auth::check()) {
            return $next($request); // Proceed if the user is authenticated
        }

        // If not authenticated, redirect to login
        return redirect()->route('layouts.header');
    }
}
