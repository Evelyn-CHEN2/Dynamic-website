<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        if ($this->input('user_type') === 'student') {
            return [
                's_number' => ['required', 'string'],
                'password' => ['required', 'string'],
            ];
        }
    
        if ($this->input('user_type') === 'teacher') {
            return [
                't_number' => ['required', 'string'],
                'password' => ['required', 'string'],
            ];
        }
    
        // Default case: return an empty rules array if user_type is missing or invalid
        return [
            'password' => ['required', 'string'],  // You can add a default rule or leave it empty
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        $credentials = $this->only('password');
        if ($this->input('user_type') === 'student') {
            $credentials['s_number'] = $this->input('s_number');
        } elseif ($this->input('user_type') === 'teacher') {
            $credentials['t_number'] = $this->input('t_number');
        }
    
        if (! Auth::attempt($credentials, $this->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey());
    
            throw ValidationException::withMessages([
                'auth' => trans('auth.failed'),
            ]);
        }
    
        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        $loginKey = $this->input('user_type') === 'student' 
        ? $this->input('s_number') 
        : $this->input('t_number');

        return Str::transliterate(Str::lower($loginKey).'|'.$this->ip());
    }
}
