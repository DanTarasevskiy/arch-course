<?php

namespace App\Http\Controllers;

class UserController extends Controller
{
    public function index()
    {
        // $products = Product::all();
        return $this->successResponse(['kek', 'pokek' , 'perekek']);
    }

    public function show($userId)
    {
        //$product = Product::findOrFail($product);
        return $this->successResponse(["MEGA user pokek with userId = $userId"]);
    }

}
