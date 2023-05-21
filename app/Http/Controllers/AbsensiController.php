<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Absensi;
use App\User;
use App\Karyawan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AbsensiController extends Controller
{

    public function index()
    {
        $today = Carbon::today();
        $employee = Karyawan::all();
        $absens = DB::table('absensi')
            ->whereDate('tanggal', $today)
            ->get();
        $namauser = Auth::user()->user_id;
        foreach ($absens as $absen) {
            $karyawan = Karyawan::find($absen->user_id);
            if ($karyawan) {
                $absen->nama_karyawan = $karyawan->name;
            } else {
                $absen->nama_karyawan = "Karyawan tidak ditemukan";
            }
        }
        $today = Carbon::today()->toDateString();
        $startDate = Carbon::now()->startOfMonth();
        $endDate = Carbon::now()->endOfMonth();

        $data12 = Absensi::leftJoin('karyawan', 'karyawan.nik', '=', 'absensi.user_id')
            ->whereDate('absensi.tanggal', $today)
            ->orWhereNull('absensi.tanggal')
            ->select('karyawan.nama', 'karyawan.nik','absensi.clock_in', 'absensi.clock_out','absensi.user_id','absensi.tanggal','absensi.nik')
            ->get();

            $tanggal = now()->format('Y-m-d');
            $data1 = DB::table('users')->leftJoin('absensi', function($join) use($startDate,$endDate) {
                         $join->on('absensi.user_id', '=', 'users.id')
                              ->whereBetween('absensi.tanggal', [$startDate,$endDate]);
                     })->select('users.*', 'absensi.*')
                       ->orderBy('users.name')
                       ->get();

        return view('pages.absensi.index',compact('absens','employee','data1','endDate','startDate'));
    }

    public function clockin(Request $request)
    {   
        $user = Auth::user();

        $time_in = Carbon::now()->format('H:i:s');
        $workday_start = Carbon::now()->startOfDay()->addHours(8)->addMinutes(30)->format('H:i:s');

        $lat = $request->input('latitude');
        $long = $request->input('longitude');
        $status = $request->input('status');
        

        $absensi = new Absensi();
        $absensi->nik = auth()->user()->nik;
        $absensi->user_id = auth()->user()->nik;
        $absensi->tanggal = now()->toDateString();
        $absensi->clock_in = now()->toTimeString();
        $absensi->latitude = $lat;
        $absensi->longitude = $long;
        $absensi->status = $status;
        $absensi->save();
        return redirect()->back()->with('success', 'Clockin success!');
}

    public function clockout(Request $request)
    {
        $lat2 = $request->input('latitude_out');
        $long2 = $request->input('longitude_out');
        $absensi = Absensi::where('nik', auth()->user()->nik)
            ->orderBy('clock_in', 'desc')
            ->first();
        
        if ($absensi) {
            $absensi->clock_out = Carbon::now()->toTimeString();
            $absensi->latitude_out = $lat2;
            $absensi->longitude_out = $long2;
            $absensi->save();

            return redirect()->back()->with('success', 'Clockout success!');
        }

        return redirect()->back()->with('error', 'No clockin record found.');
    }

    public function show($id)
    {
        $absensi = Absensi::where('id', $id)
                     ->whereDate('tanggal', now())
                     ->firstOrFail();

        return view('pages.absensi.show', compact('absensi'));
    }
}