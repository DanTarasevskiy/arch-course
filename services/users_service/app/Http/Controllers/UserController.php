<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return $this->successResponse($users);
    }

    public function show($id)
    {
        $user = User::find($id);
        return $this->successResponse($user);
    }

    public function store(Request $request)
    {
        try {
            $rules = [
                'login' => 'unique:users|required|string|max:64',
                'password' => 'required|string|min:8|max:64'
            ];
            $this->validate($request, $rules);
            $params = $request->all();
            $user = User::create([
                'login' => $params['login'],
                'password' => Hash::make($params['password']),
            ]);
            return $this->successResponse($user);
        } catch (\Illuminate\Validation\ValidationException $ex) {
            return $this->errorResponse($ex->errors(), 400);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $rules = [
                'login' => 'unique:users|string|max:64',
                'password' => 'string|min:8|max:64'
            ];

            $this->validate($request, $rules);
            $user = User::findOrFail($id);

            $params = $request->all();
            if (empty($params)) {
                return $this->errorResponse('at least one value must be change',
                    Response::HTTP_UNPROCESSABLE_ENTITY);
            }
            $user = $user->fill([
                'login' => $params['login'] ?? $user->login,
                'password' => isset($params['password']) ? Hash::make($params['password']) : $user->password,
            ]);

            $user->save();
            return $this->successResponse($user);
        } catch (\Illuminate\Validation\ValidationException $ex) {
            return $this->errorResponse($ex->errors(), 400);
        }
    }


    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return $this->successResponse($user);
    }


}
