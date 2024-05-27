<?php

namespace App\Http\Controllers;

use App\Models\User;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    private $key;
    private $expirationMinutes = 120;

    public function __construct()
    {
        try{
            $this->key = file_get_contents(".well-known/private_key.txt");
        } catch (\Exception $e){
            return $this->errorResponse('private_key.txt not found!', Response::HTTP_INTERNAL_SERVER_ERROR);

        }
    }

    /**
     * Аутентификация, генерация токена
     * @param Request $request
     */
    public function index(Request $request)
    {
        $params = $request->all();
        if (!isset($params['login'], $params['password'])) {
            return $this->errorResponse('Not exists login or password!', Response::HTTP_BAD_REQUEST);
        }
        $user = User::where('login', $params['login'])->first();

        if (!isset($user)) {
            return $this->errorResponse('Not valid login!', Response::HTTP_UNAUTHORIZED);
        }

        if(!Hash::check($params['password'], $user->password)){
            return $this->errorResponse('Not valid password!', Response::HTTP_UNAUTHORIZED);
        }

        $payload = $user->toArray();
        $payload['iat'] = date('now');
        $payload['exp'] = time() + ($this->expirationMinutes * 60);
        $jwt = JWT::encode($payload, $this->key, 'RS256');
        return $this->successResponse($jwt);

    }


    /**
     * Проверка валидности токена авторизации
     */
    public function check(Request $request)
    {
        $token = $request->header('Bearer');
        try {
            $jwks = json_decode(file_get_contents(".well-known/jwks.json"));
            $jwk = $jwks->keys[0]->x5c[0];
            $decoded = JWT::decode($token, new Key($jwk, 'RS256'));

            return $this->successResponse($decoded);
        } catch (\Firebase\JWT\ExpiredException $e) {
            return $this->errorResponse('Token expired!', Response::HTTP_UNAUTHORIZED);
        } catch (\Firebase\JWT\SignatureInvalidException $e) {
            return $this->errorResponse('Invalid signature!', Response::HTTP_UNAUTHORIZED);
        } catch (\Exception $e) {
            return $this->errorResponse('jwks not found!', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /*public function store(Request $request)
    {
        try {
            $rules = [
                'login' => 'unique:users|required|string|max:64',
                'password' => 'required|string|min:8|max:64',
                'name' => 'required|string',
                'surname' => 'required|string',
            ];
            $this->validate($request, $rules);
            $params = $request->all();
            $user = User::create([
                'login' => $params['login'],
                'password' => Hash::make($params['password']),
                'name' => $params['name'],
                'surname' => $params['surname'],
            ]);
            return $this->successResponse($user);
        } catch (\Illuminate\Validation\ValidationException $ex) {
            return $this->errorResponse($ex->errors(), Response::HTTP_BAD_REQUEST);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $rules = [
                'login' => 'unique:users|string|max:64',
                'password' => 'string|min:8|max:64',
                'name' => 'string',
                'surname' => 'string',
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
                'name' => $params['name'] ?? $user->name,
                'surname' => $params['surname'] ?? $user->surname,
            ]);

            $user->save();
            return $this->successResponse($user);
        } catch (\Illuminate\Validation\ValidationException $ex) {
            return $this->errorResponse($ex->errors(), Response::HTTP_BAD_REQUEST);
        }
    }


    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return $this->successResponse($user);
    }*/


}
