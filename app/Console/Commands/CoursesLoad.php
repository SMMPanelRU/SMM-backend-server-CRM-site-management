<?php

namespace App\Console\Commands;

use App\Jobs\CurrencyCourseLoadJob;
use App\Models\Currency;
use Illuminate\Console\Command;

class CoursesLoad extends Command
{
    protected $signature   = 'courses:load';
    protected $description = 'Export systems syncing';

    public function handle()
    {

        $currencies = Currency::all();

        foreach ($currencies as $currency) {
            CurrencyCourseLoadJob::dispatch($currency);
        }


        exit(0);
    }
}
