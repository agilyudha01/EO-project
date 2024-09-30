<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('register');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|max:255',
            'email'=>'required|email:dns|unique:users',
            'password' => 'required|min:5|max:225'
        ]);
        // dd($validateData);
        // dd($request);
        $validateData['password'] = bcrypt($validateData['password']);
        User::create($validateData);
        return redirect('/login');


    }

    
}
