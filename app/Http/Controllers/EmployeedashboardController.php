<?php

namespace App\Http\Controllers;

use App\Karyawan;
use App\User;
use App\Absensi;
use Carbon\Carbon;
use App\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EmployeedashboardController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $user = Auth::user();
                if($user->id){
                    if($user->level = '2'){
                        $karyawan = Karyawan::all();
                        $lastAbsensi = $user->absensi()->latest()->first();
                        // Get Data Karyawan
                        $userId = Auth::id();
                        $hariini = now()->format('Y-m-d');
                        $datakaryawan = Karyawan::join('users', 'karyawan.nik', '=', 'users.id')
                            ->where('users.id', $userId)
                            ->select('karyawan.*')
                            ->get();
                        // Get Gambar
                        foreach ($karyawan as $data) {
                            if($data->organisasi == 'Professional Frontline'){
                                $frontline = "labor.png";
                            }else if($data->organisasi == 'Management Leaders'){
                                $frontline = "laptop.png";
                            }
                        }
                        // Get Log Absensi

                        $logs = Absensi::where('user_id', $userId)
                            ->whereDate('tanggal', $hariini)
                            ->get();

                        // Remove Absen Button
                        $alreadyClockIn = false;
                        $alreadyClockOut = false;
                        $isSameDay = false;
                        if ($lastAbsensi) {
                            if ($lastAbsensi->clock_in && !$lastAbsensi->clock_out) {
                                $alreadyClockIn = true;
                            } elseif ($lastAbsensi->clock_in && $lastAbsensi->clock_out) {
                                $alreadyClockOut = true;
                                $lastClockOut = Carbon::parse($lastAbsensi->clock_out);
                                $today = Carbon::today();
                                $isSameDay = $lastClockOut->isSameDay($today);
                            }
                        }

                        // Greating
                        date_default_timezone_set('Asia/Jakarta'); // Set timezone sesuai dengan lokasi Anda
                        $hour = date('H'); // Ambil jam saat ini

                        if ($hour >= 5 && $hour < 12) {
                            $greeting = 'Selamat Pagi';
                        } else if ($hour >= 12 && $hour < 18) {
                            $greeting = 'Selamat Siang';
                        } else {
                            $greeting = 'Selamat Malam';
                        }

                        // Get Pengumuman

                        $pengumuman = Pengumuman::all()->take(5);
                        $count = count($pengumuman);

                        return view('employee.index',compact('karyawan','alreadyClockIn','alreadyClockOut','isSameDay','datakaryawan','logs','greeting','frontline','hariini','pengumuman','count'));
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
