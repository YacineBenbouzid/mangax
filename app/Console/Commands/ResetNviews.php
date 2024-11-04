<?php

namespace App\Console\Commands;

use App\Models\manga;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ResetNviews extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'nviews:reset';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Reset daily views
        manga::query()->update(['nvd' => 0]);

        // Check if it's the start of a new week (Sunday)
        if (now()->isFriday()) {
            manga::query()->update(['nvw' => 0]);
        }

        // Check if it's the start of a new month (1st of the month)
        $date = Carbon::now();

        if ($date->day === 1) {
            manga::query()->update(['nvm' => 0]);
        }

        $this->info('Views reset successfully: daily, weekly, and monthly as required.');
    }
}
