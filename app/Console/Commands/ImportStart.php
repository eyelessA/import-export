<?php

namespace App\Console\Commands;

use App\Imports\AdditionalFieldsImport;
use App\Imports\ImagesImport;
use App\Imports\ProductsImport;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ImportStart extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-start';
    //php artisan app:import-start

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        Excel::import(new ProductsImport(), 'public/import example.xlsx');
        Excel::import(new ImagesImport(), Storage::disk('public')->path('import example.xlsx'));
        Excel::import(new AdditionalFieldsImport(), 'public/import example.xlsx');
    }
}
