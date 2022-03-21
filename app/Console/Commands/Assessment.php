<?php

namespace App\Console\Commands;

use App\Classes\StringTransformation;
use Illuminate\Console\Command;


class Assessment extends Command
{
    protected $string = '';
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cli:test';

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
        $stringInput = $this->ask("Enter your desired string");
        if (!is_string($stringInput) || $stringInput === ''){
            $this->error("Invalid input, a string is required");
            exit();
        }
        $stringTransformation = new StringTransformation($stringInput);
        $this->info($stringTransformation->getUpperCase());
        $this->info($stringTransformation->getAlternateCase());
        if($stringTransformation->outputCsv()){
            $this->info('CSV created!');
        } else {
            $this->error("CSV not created");
        }
    }
}
