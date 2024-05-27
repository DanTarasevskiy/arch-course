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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->group(['prefix' => 'auth'], function () use ($router) {
        $router->get('/', ['uses' => 'AuthController@check']);
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
