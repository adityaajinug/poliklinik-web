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
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'username' => 'required|string|max:255|unique:users,username',
                'password' => 'required|min:8',
                'password_confirmation' => 'required|same:password'
            ]);
    
            User::create([
                'username' => $request->username,
                'password' => Hash::make($request->password),
            ]);
            
            return redirect()->route('login.index', [
                'status' => 'success',
                'message' => 'Registration successful! Please log in.'
            ]);
        } catch(\Exception $e) {
            Log::error(['error' => $e->getMessage()]);
            return redirect()->route('register.index')->with([
                'status' => 'error',
                'message' => 'Registration failed! Please try again.'
            ]);
        }
    }
}
