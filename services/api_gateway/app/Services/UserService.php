<?php

declare(strict_types = 1);

namespace App\Services;

use App\Traits\RequestService;

use function config;

class UserService
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
        $this->baseUri = config('services.users.base_uri');
        $this->secret = config('services.users.secret');
    }

    public function fetchUsers() : string
    {
        return $this->request('GET', '/api/user');
    }

    public function fetchUser($id) : string
    {
        return $this->request('GET', "/api/user/{$id}");
    }

    public function createUser($data) : string
    {
        return $this->request('POST', '/api/user', $data);
    }

    public function updateUser($id, $data) : string
    {
        return $this->request('PATCH', "/api/user/{$id}", $data);
    }

    public function deleteUser($id) : string
    {
        return $this->request('DELETE', "/api/user/{$id}");
    }
}
