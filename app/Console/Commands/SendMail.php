<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use League\Flysystem\Config;

class SendMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'yier:cron {class_name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '计划任务执行';

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
        $class_name = $this->argument('class_name');
        list($class,$method) = explode('@',$class_name);
        $return = $class::$method();
        Log::info($class.'下的'.$method.'方法执行结果为'.$return.'========================');
    }
}
