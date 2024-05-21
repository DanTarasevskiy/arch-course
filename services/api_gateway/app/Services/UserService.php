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

    /**
     * @return string
     */
    public function fetchUsers() : string
    {
        return $this->request('GET', '/api/user');
    }

    /**
     * @param $id User ID
     *
     * @return string
     */
    public function fetchUser($id) : string
    {
        return $this->request('GET', "/api/user/{$id}");
    }

//    /**
//     * @param $data
//     *
//     * @return string
//     */
//    public function createOrder($data) : string
//    {
//        return $this->request('POST', '/api/order', $data);
//    }
//
//    /**
//     * @param $order
//     * @param $data
//     *
//     * @return string
//     */
//    public function updateOrder($order, $data) : string
//    {
//        return $this->request('PATCH', "/api/order/{$order}", $data);
//    }
//
//    /**
//     * @param $order
//     *
//     * @return string
//     */
//    public function deleteOrder($order) : string
//    {
//        return $this->request('DELETE', "/api/order/{$order}");
//    }
}
