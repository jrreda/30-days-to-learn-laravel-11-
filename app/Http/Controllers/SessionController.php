<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show()
    {
        return view('auth.login');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $credintials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required',],
            // 'password' => ['required', Password::min(6)->letters()->numbers()->symbols()],
        ]);

        if (! Auth::attempt($credintials)) {
            throw ValidationException::withMessages([
                'email'    => ['The provided credentials do not match our records.'],
                // 'password' => ['The provided credentials do not match our records.'],
            ]);
        }

        $request->session()->regenerate();

        return redirect('/jobs');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        Auth::logout();

        return redirect('/');
    }
}
