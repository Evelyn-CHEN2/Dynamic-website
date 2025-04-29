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
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            's_number' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        $s_number = $request->s_number;
        $user_name = $request->name;
        $user_exist = User::where('name', $user_name)->first();
        if($user_exist) {
            $user_exist->update([
                'email' => $request->email,
                's_number' =>$request->s_number,
                'password' => Hash::make($request->password),
                'is_registered' => true,
            ]);
            $user = $user_exist;
        }else{
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                's_number' => $request->s_number,
                'password' => Hash::make($request->password),
                'is_registered' => true,  //set user to be registered
                'user_type' => 'student',
            ]);
        }

        event(new Registered($user));

        // Auth::login($user);
        // return redirect(route('login', absolute: false))->with([
        //     'user_type' => 'student', 
        //     's_number' => $s_number
        // ]);
        return redirect()->route('welcome');
    }
}
