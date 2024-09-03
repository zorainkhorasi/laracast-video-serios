<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RegisterUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        
        //validate user
        //store the user 
        //login user
        //redirect user

        $validateAttributes=$request->validate([
            'name'=>'required',
            'email'=>'required|max:255',
            'password'=>['required','confirmed'],
        ]);

        $user=User::create($validateAttributes);
        Auth::login($user);

        return redirect()->route('jobs.index');

    }

}
