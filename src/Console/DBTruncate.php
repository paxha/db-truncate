<?php

namespace DBTruncate\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

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
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function handle()
    {
        if (env('DB_CONNECTION') != 'sqlite') {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        }

        $tables = Schema::getConnection()->getDoctrineSchemaManager()->listTableNames();
        foreach ($tables as $table) {
            if ($table == 'migrations') {
                continue;
            }
            $this->comment($table . ' table truncating...');
            DB::table($table)->truncate();
            $this->info($table . ' table truncate success.');
        }
        if (env('DB_CONNECTION') != 'sqlite') {
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }
    }
}
