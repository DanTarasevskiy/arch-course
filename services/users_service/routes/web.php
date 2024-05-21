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
    $router->group(['prefix' => 'user'], function () use ($router) {
        $router->get('/', ['uses' => 'UserController@index']);
        $router->get('/{userId}', ['uses' => 'UserController@show']);
    /*    $router->post('/', ['uses' => 'ProductController@store']);
        $router->get('/{product}', ['uses' => 'ProductController@show']);
        $router->patch('/{product}', ['uses' => 'ProductController@update']);
        $router->delete('/{product}', ['uses' => 'ProductController@destroy']);*/
    });
});
