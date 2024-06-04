<?php

declare(strict_types = 1);

namespace App\Services;

use App\Traits\RequestService;

use Illuminate\Http\Request;
use function config;

class P2PChatService
{
    use RequestService;

    /**
     * @var string
     */
    protected $baseUri;

    /**
     * @var string
     */
    protected $secret;

    public function __construct()
    {
        $this->baseUri = config('services.p2p-chat.base_uri');
        $this->secret = config('services.p2p-chat.secret');
    }

    public function getChats(array $params = []) : string
    {
        return $this->request('GET', '/api/chat', $params);
    }

    public function getChat($id) : string
    {
        return $this->request('GET', "/api/chat/{$id}");
    }

    public function createChat($data) : string
    {
        return $this->request('POST', '/api/chat', $data);
    }

    public function createMessage($id, $data) : string
    {
        return $this->request('POST', "/api/chat/{$id}", $data);
    }

}
