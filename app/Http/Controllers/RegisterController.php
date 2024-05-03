<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show()
    {
        return view('auth.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name'  => ['required', 'string'],
            'last_name'  => ['required', 'string'],
            'email'      => ['required', 'email'],
            'password'   => ['required', Password::min(6), 'confirmed'],
            // 'password'   => ['required', Password::min(6)->letters()->numbers()->symbols(), 'confirmed'],
        ]);

        $user = User::create($validated);

        Auth::login($user);

        return redirect('/jobs');
    }
}
