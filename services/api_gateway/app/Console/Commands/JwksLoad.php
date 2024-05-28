<?php


namespace App\Console\Commands;

use GuzzleHttp\Client;
use Illuminate\Console\Command;
use \Exception;


class JwksLoad extends Command
{

    /**
     * Имя и сигнатура консольной команды.
     *
     * @var string
     */
    protected $signature = 'jwks:load';

    /**
     * Описание консольной команды.
     *
     * @var string
     */
    protected $description = 'Load public keys (jwks) for current service';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        if (!is_dir(".well-known")) {
            mkdir(".well-known");
        }
       // $this->request('GET', "/api/user/{$id}")
        $client = new Client(['base_uri' => 'http://users_service:80']);
        $response = $client->request('GET', '.well-known/jwks.json');

        $jwks = $response->getBody()->getContents();
        file_put_contents(".well-known/jwks.json", $jwks);
    }
}
