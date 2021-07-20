<?php

namespace Igaster\LaravelCities\commands;

use Igaster\LaravelCities\commands\helpers\geoCollection;
use Igaster\LaravelCities\Geo;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use PDO;
use Symfony\Component\Console\Helper\ProgressBar;

class seedJsonFile extends Command
{
    protected $signature = 'geo:json {file?}';
    protected $description = 'Load a json file.';

    public function __construct()
    {
        parent::__construct();

        $this->geoItems = new geoCollection();
    }

    public function handle()
    {
        $this->pdo = DB::connection()->getPdo(PDO::FETCH_ASSOC);
        if (! Schema::hasTable('geo')) {
            return;
        }
        
        $start = microtime(true);

        $filename = $this->argument('file');

        if (empty($filename)) {
            $this->info('Available json files:');
            $this->info('---------------------');
            $files = array_diff(scandir(storage_path('geo')), ['.', '..']);
            foreach ($files as $file) {
                if (strpos($file, '.json') !== false) {
                    $this->comment(' ' . substr($file, 0, strpos($file, '.json')));
                }
            }
            $this->info('---------------------');
            $filename = $this->ask('Choose File to restore:');
        }

        $filename = storage_path("geo/{$filename}.json");
        $this->info("Parsing file: $filename");

        $data = json_decode(file_get_contents($filename), true);
        if ($data === null) {
            $this->error('Error decoding json file. Check for syntax errors.');
            exit();
        }

        $progressBar = new ProgressBar($this->output, count($data));
        $count = 0;
        $rebuildTree = false;
        foreach ($data as $item) {
            if (isset($item['id']) && ($geo = Geo::find($item['id']))) {
                $geo->update($item);
            } else {
                $item = array_merge([
                    'alternames' => [],
                    'country' => '',
                    'level' => '',
                    'population' => 0,
                    'lat' => 0,
                    'long' => 0,
                ], $item);
                Geo::create($item);
                $rebuildTree = true;
            }
            $progressBar->setProgress($count++);
        }
        $progressBar->finish();
        $this->info(" Finished Processing $count items");

        if ($rebuildTree) {
            $this->info('Rebuilding Tree in DB');
            Geo::rebuildTree($this->output);
        }

        $time_elapsed_secs = microtime(true) - $start;
        $this->info("Timing: $time_elapsed_secs sec</info>");
    }
}
