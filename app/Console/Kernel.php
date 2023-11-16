<?php

namespace App\Console;

use Carbon\Carbon;
use App\Models\Presensi;
use Illuminate\Console\Scheduling\Schedule;
use App\Console\Commands\AddPresensiAlfaCommand;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        // AddPresensiAlfaCommand::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $presensis = Presensi::all();
        
            foreach ($presensis as $presensi) {
                $lastUpdated = $presensi->updated_at;
        
                if ($lastUpdated && $lastUpdated->format('Y-m-d') != Carbon::now()->format('Y-m-d')) {
                    $presensi->status = 'tidak hadir';
                    $presensi->save();
                }
            }
        })->daily();
        
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
