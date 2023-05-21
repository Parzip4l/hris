<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Torann\GeoIP\Facades\GeoIP;

class LoginController extends Controller
{

    public function index() {
        if($warga = Auth::user()){
            if($warga->level == '1'){
                return redirect()->intended('dashboard');
            }elseif($warga->level == '2'){
                return redirect()->intended('employee');
            }
        }
        
        return view('pages.auth.login');
    }

    public function proses(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
           $request->session()->regenerate();
           $warga = Auth::user();
                if($warga->level == '1'){
                    return redirect()->intended('dashboard');
                }elseif($warga->level == '2'){
                    return redirect()->intended('employee');
                }
            return redirect()->intended('login');    
        }

        return back()->withErrors([
            'email' => 'email Atau Password Salah'
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

        return redirect('/');
    }
}