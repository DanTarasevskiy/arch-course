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

//use App\Http\Controllers\UserController;

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->group(['prefix' => 'auth'], function () use ($router) {
        $router->post('/', ['uses' => 'UserController@auth']);
    });
    $router->group(['prefix' => 'user', 'middleware' => ['user-access']], function () use ($router) {
        $router->get('/', ['uses' => 'UserController@index']);
        $router->get('{id}', ['uses' => 'UserController@getUser']);
        $router->post('/', ['uses' => 'UserController@store']);
        $router->patch('/{id}', ['uses' => 'UserController@update']);
        $router->delete('/{id}', ['uses' => 'UserController@destroy']);
    });

    $router->group(['prefix' => 'p2p-chat', 'middleware' => ['user-access']], function () use ($router) {
        $router->get('/', ['uses' => 'P2PChatController@getChats']);
        $router->get('{id}', ['uses' => 'P2PChatController@getChat']);
        $router->post('/', ['uses' => 'P2PChatController@createChat']);
        $router->post('/{id}', ['uses' => 'P2PChatController@createMessage']);
    });
});
