<?php

namespace App\Http\Middleware;

use App\Traits\ApiResponse;
use Closure;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Http\Response;

class Authenticate
{
    use ApiResponse;

    /**
     * Проверка валидности токена авторизации
     */
    public function handle($request, Closure $next)
    {
        $token = $request->bearerToken();
        if(empty($token)){
            return $this->errorResponse('Bearer token not found!', Response::HTTP_UNAUTHORIZED);
        }

        try {
            $jwks = json_decode(file_get_contents(base_path() . "/.well-known/jwks.json"));
            $jwk = $jwks->keys[0]->x5c[0];
            // dd($token, $jwk,);
            $decoded = JWT::decode($token, new Key($jwk, 'RS256'));
            $request->user = $decoded;
            return $next($request);
        } catch (\Firebase\JWT\ExpiredException $e) {
            return $this->errorResponse('Token expired!', Response::HTTP_UNAUTHORIZED);
        } catch (\Firebase\JWT\SignatureInvalidException $e) {
            return $this->errorResponse('Invalid signature!', Response::HTTP_UNAUTHORIZED);
        } catch (\Exception $e) {
            return $this->errorResponse('Invalid token!', Response::HTTP_UNAUTHORIZED);
        }
    }
}
