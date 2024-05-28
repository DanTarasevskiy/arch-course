<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('.well-known/jwks.json', function () {
    header('Content-Type: application/json; charset=utf-8');
    echo file_get_contents(base_path() . "/.well-known/jwks.json");
});

$router->group(['prefix' => 'api', 'middleware' => [App\Http\Middleware\AuthenticateAccess::class]], function () use ($router) {
    $router->group(['prefix' => 'auth'], function () use ($router) {
        $router->get('/{token}', ['uses' => 'AuthController@check']);
        $router->post('/', ['uses' => 'AuthController@index']);
    });

    $router->group(['prefix' => 'user'], function () use ($router) {
        $router->get('/', ['uses' => 'UserController@index']);
        $router->get('/{id}', ['uses' => 'UserController@show']);
        $router->post('/', ['uses' => 'UserController@store']);
        $router->patch('/{id}', ['uses' => 'UserController@update']);
        $router->delete('/{id}', ['uses' => 'UserController@destroy']);
    });
});
