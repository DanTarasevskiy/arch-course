<?php


namespace App\Console\Commands;

use Illuminate\Console\Command;
use \Exception;


class AskmeCommand extends Command
{


    protected $signature = "askme";

    protected $description = "Ask Me";

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->question("ask me question?");
        try {
            $this->info("Hello World");
        } catch (Exception $e) {
            $this->error($e->getMessage());
        }
    }
}
