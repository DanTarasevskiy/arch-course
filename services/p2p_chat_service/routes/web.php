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

$router->group(['prefix' => 'api', 'middleware' => [App\Http\Middleware\Authenticate::class, App\Http\Middleware\AuthenticateAccess::class]], function () use ($router) {
    $router->group(['prefix' => 'chat'], function () use ($router) {
        $router->get('/', ['uses' => 'ChatController@getChats']);
        $router->get('/{id}', ['uses' => 'ChatController@getChat']);
        $router->post('/', ['uses' => 'ChatController@createChat']);
        $router->post('/{id}', ['uses' => 'ChatController@createMessage']);
    });
});
