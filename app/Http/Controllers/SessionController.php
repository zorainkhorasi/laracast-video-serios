<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;


class SessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        //validate

        $validateAttributes=$request->validate([
            'email'=>"required",
            "password"=>"required",
        ]);

        if(!Auth::attempt($validateAttributes))
        {
            Throw ValidationException::withMessages([
                'email'=>'Sorry, Credentials doesnt match '
            ]);
        }

        request()->session()->regenerate();
                

        return redirect()->route('jobs.index');
        //check attempt
        //redirect
    }

    public function destroy()
    {
        // dd(Auth::user());

        Auth::logout();

        return redirect()->route('jobs.index');
    }
}
