<?php

namespace Paxha\DBTruncate\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class DBTruncate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:truncate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Truncate all db tables';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        DB::statement("SET foreign_key_checks=0");
        $db = "Tables_in_" . DB::connection()->getDatabaseName();
        $tables = DB::connection()->select('SHOW TABLES');
        foreach ($tables as $table) {
            if ($table->{$db} == 'migrations') {
                continue;
            }
            $this->comment($table->{$db} . ' table truncating...');
            DB::table($table->{$db})->truncate();
            $this->info($table->{$db} . ' table truncate success.');
        }
        DB::statement("SET foreign_key_checks=1");
    }
}
