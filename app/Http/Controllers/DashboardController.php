<?php

namespace App\Http\Controllers;

use App\Karyawan;
use App\User;
use App\Absensi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
    if (Auth::check()) {
        $user = Auth::user();
        $karyawan = Karyawan::all();
            if($user->id){
                $karyawan = Karyawan::all();
                if($user->level = '1'){
                    $karyawan = Karyawan::all();
                    return view('dashboard', compact('karyawan'));
                }else{
                    return redirect('pages.auth.login')->intended('login');
                }
            }else{
                return view('dashboard',compact('karyawan'));
            }
        }else{
            return redirect()->route('login');
        }
    }
}
