<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
 
class LoginController extends Controller
{
    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('login');
    }
    public function authenticate(Request $request)
    {
        // dd($request);
        $credentials = $request->validate([
            'email' => ['required', 'email:dns'],
            'password' => ['required'],
        ]);
        // dd($credentials);
 
        if (Auth::attempt($credentials)) {
            // Regenerasi sesi untuk keamanan
            $request->session()->regenerate();

            // Arahkan user ke dashboard berdasarkan role mereka
            $user = Auth::user();
            if ($user->level_user === 'admin') {
                return redirect()->intended('/admin/event-package');
            } elseif ($user->level_user === 'super_admin') {
                return redirect()->intended('/super-admin/dashboard');
            } else {
                return redirect()->intended('/');
            }
        }
        
 
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
}