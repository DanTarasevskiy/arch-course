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
        $this->userService = $userService;
        // $this->productService = $productService;
    }

    public function index(Request $request)
    {
        return $this->successResponse($this->userService->fetchUsers($request->all()));
    }

    public function getUser($id)
    {
        return $this->successResponse($this->userService->fetchUser($id));
    }

    public function store(Request $request)
    {
        return $this->successResponse($this->userService->createUser($request->all()));
    }

    public function update(Request $request, $id)
    {
        return $this->successResponse($this->userService->updateUser($id, $request->all()));
    }

    public function destroy($id)
    {
        return $this->successResponse($this->userService->deleteUser($id));
    }

}
