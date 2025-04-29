<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\CourseController;
use App\Models\User;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;


class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(Request $request): View
    {
        $user_type = $request->input('user_type');
        return view('auth.login')->with('user_type', $user_type);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // $request->authenticate();

        // $request->session()->regenerate();

        // return redirect()->intended(route('course.index', absolute: false));
        $credentials = $request->validate([
            's_number' => 'nullable|string',
            't_number' => 'nullable|string',
            'password' => 'required|string',
            'user_type' => 'required|string',
        ]);
      
        $user_type = $request->input('user_type');
     
        if ($user_type === 'student') {
            $user = User::where('s_number', $request->s_number)->first();
        } elseif ($user_type === 'teacher') {
            $user = User::where('t_number', $request->t_number)->first();
        }
        
        // Check if user exists and if the password matches
        if ($user && Hash::check($request->password, $user->password)) {
            // Log in the user
            Auth::login($user);
            return redirect()->intended(route('course.index', absolute: false));
        }
    
        // Return back with error if credentials don't match
        return back()->withErrors([
            'login' => 'The provided credentials do not match our records.',
        ]);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
