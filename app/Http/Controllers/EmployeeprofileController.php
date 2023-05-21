<?php

namespace App\Http\Controllers;

use App\Karyawan;
use App\User;
use App\Absensi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EmployeeprofileController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $user = Auth::user();
                if($user->id){
                    if($user->level = '2'){
                        $karyawan = Karyawan::all();
                        $userId = Auth::id();
                        $datakaryawan = Karyawan::join('users', 'karyawan.nik', '=', 'users.id')
                            ->where('users.id', $userId)
                            ->select('karyawan.*')
                            ->get();

                            // Greeting
                            date_default_timezone_set('Asia/Jakarta'); // Set timezone sesuai dengan lokasi Anda
                            $hour = date('H'); // Ambil jam saat ini

                            if ($hour >= 5 && $hour < 12) {
                                $greeting = 'Selamat Pagi';
                            } else if ($hour >= 12 && $hour < 18) {
                                $greeting = 'Selamat Siang';
                            } else {
                                $greeting = 'Selamat Malam';
                            }

                        return view('employee.profile',compact('karyawan','datakaryawan','greeting'));
                    }else{
                        return redirect('pages.auth.login')->intended('login');
                    }
                }else{
                    
                }
            }else{
                return redirect()->route('login');
            }
        }
}
