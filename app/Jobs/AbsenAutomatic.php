<?php

namespace App\Jobs;

use App\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;


class AbsenAutomatic implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */

    protected $signature = 'absen:automatic';
    public function handle()
    {
        $users = User::all();

        foreach ($users as $user) {
            $absensi = $user->absensi()->whereDate('clock_in', Carbon::today())->first();

            if (!$absensi) {
                $user->absensi()->create([
                    'clock_in' => '-',
                    'clock_out' => '-',
                    'latitude' => '-',
                    'longitude' => '-',
                    'latitude_out' => '-',
                    'longitude_out' => '-',
                    'status' => 'A',
                ]);
            }
        }
    }
}
