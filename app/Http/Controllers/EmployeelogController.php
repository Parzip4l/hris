<?php

namespace App\Http\Controllers;

use App\Karyawan;
use App\User;
use App\Absensi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class EmployeelogController extends Controller
{
    public function index(Request $request)
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

                        $startOfMonth = Carbon::now()->startOfMonth();
                        $endOfMonth = Carbon::now()->endOfMonth();

                        // Get logs for the month
                        $logsmonths = Absensi::where('user_id', $userId)
                        ->whereBetween('tanggal', [$startOfMonth, $endOfMonth])
                        ->orderByDesc('tanggal')
                        ->get();

                        $bulan = $request->input('bulan');

                        if ($bulan) {
                            $logsfilter = DB::table('absensi')
                                ->whereMonth('tanggal', '=', date('m', strtotime($bulan)))
                                ->whereYear('tanggal', '=', date('Y', strtotime($bulan)))
                                ->get();
                        } else {
                            $logsfilter = DB::table('absensi')->get();
                        }

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

                        return view('employee.log',compact('karyawan','alreadyClockIn','alreadyClockOut','isSameDay','datakaryawan','logs','greeting','frontline','logsmonths','logsfilter'));
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
