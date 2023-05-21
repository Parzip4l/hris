<?php

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AbsenAutomatic extends Command
{
    protected $signature = 'absen:automatic';
    protected $description = 'Input absen otomatis jika karyawan tidak absen pada hari itu.';

    public function handle()
    {
        $now = Carbon::now();
        $users = DB::table('users')->get();
        

        foreach ($users as $user) {
            $already_absen = DB::table('absensi')
                                ->where('user_id', $user->id)
                                ->whereDate('created_at', $now->toDateString())
                                ->count();

            if ($already_absen === 0) {
                $absensi = new Absensi();
                $absensi->tanggal = now()->toDateString();
                $absensi->clock_in = '-';
                $absensi->latitude = '-';
                $absensi->longitude = '-';
                $absensi->status = 'A';
                $absensi->save();
            }
        }

        $this->info('Input absen otomatis selesai.');
    }
}