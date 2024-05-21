<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @var \App\Services\UserService
     */
    protected $userService;

    /**
     * @var \App\Services\ProductService
     */
    protected $productService;

    /**
     * UserController constructor.
     *
     * @param \App\Services\UserService $userService
     * @param \App\Services\ProductService $productService
     */
    public function __construct(UserService $userService/*, ProductService $productService*/)
    {
        //dd('lol');
        $this->userService = $userService;
        // $this->productService = $productService;
    }

    /**
     * @return mixed
     */
    public function index()
    {

        return $this->successResponse($this->userService->fetchUsers());
    }

    /**
     * @param $userId
     *
     * @return mixed
     */
    public function show($userId)
    {
        return $this->successResponse($this->userService->fetchUser($userId));
    }


}
